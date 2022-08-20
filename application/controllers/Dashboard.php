<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')==FALSE) {
			redirect('login','refresh');
		}
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function detail_produk()
	{
		$this->db->where('id_produk',$this->input->get('id_produk'));
		$data = $this->db->get('tbl_informasi_produk')->result();
		echo  json_encode($data);
	}


	public function get_option_laporan()
	{
		$this->db->select('id_user,nama');
		$this->db->where('level','Marketing');
		if ($this->session->level=="Supervisor") {
		$this->db->where('id_cabang',$this->session->cabang);
		}
		$this->db->where('level','Marketing');

		$this->db->where('status_user',1);
		$data['marketing'] = $this->db->get('tbl_master_user')->result();

		$this->db->select('id_cabang,nama_cabang');
		$this->db->where('status_cabang',1);
		$data['cabang'] = $this->db->get('tbl_master_cabang')->result();
		echo json_encode($data);
	}
	public function index()
	{
		$this->db->select('sum(besar_plafon) as jumlah');
		$this->db->where('YEAR(tanggal_input)',date('Y'));
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['pengajuan_total'] = $this->db->get('tbl_pengajuan')->result();

		$this->db->where('status','Realisasi');
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['total_progress'] = $this->db->get('tbl_pengajuan')->num_rows();


		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}

		$data['jumlah_pengajuan'] = $this->db->get('tbl_pengajuan')->num_rows();


		$this->db->where('status!=','Realisasi');
		$this->db->where('status!=','Tolak');
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}
		$data['nasabah_baru'] = $this->db->get('tbl_pengajuan')->num_rows();
		$this->db->select('count(nama_nasabah) as jumlah');
		$this->db->where('YEAR(tanggal_input)',date('Y'));
		if ($this->session->level!="Admin" && $this->session->level!="Supervisor") {
			$this->db->where('id_cabang',$this->session->cabang);
		}

		$data['potensi_total'] = $this->db->get('tbl_nasabah')->result();

		$this->db->where('a.status_kategori',1);
		$data['kategori_produk'] = $this->db->get('tbl_kategori_produk a')->result();
		$this->db->where('a.status_produk',1);
		$this->db->join('tbl_informasi_produk b','b.id_produk=a.id_produk','left');
		$data['produk'] = $this->db->get('tbl_master_produk a')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/tampilan_dashboard',$data);  
		$this->load->view('templates/footer');
	}


	public function ubah_password()
	{
		$data_password = array(
			'password' => md5($this->input->post('password_baru_user')),
		);
		$this->db->where('id_user', $this->session->id_user);
		$result = $this->db->update('tbl_master_user', $data_password);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Password Berhasil Diubah!';
			$data['icon'] = 'success';
			$data['logout'] = 'Y';
		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Password Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('dashboard', 'refresh');
	}

	public function ubah_profil()
	{
		if (!is_dir('assets/img/foto_user/')) {
			mkdir('assets/img/foto_user/');
		}
		$foto = $this->input->post('lampiran_avatar_lama');

		if($_FILES['lampiran_avatar']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_avatar']['name']);
			$location ='assets/img/foto_user/logo'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_avatar']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}

		$data_profil = array(
			'nama' => $this->input->post('nama_lengkap_user'),
			'email' => $this->input->post('email_user'),
			'foto' => $foto, 

		);
		$this->db->where('id_user',$this->session->id_user);
		$result = $this->db->update('tbl_master_user',$data_profil);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Profil Berhasil Diubah!';
			$data['icon'] = 'success';
			$this->session->set_userdata('nama',$this->input->post('nama_lengkap_user'));
			$this->session->set_userdata('email',$this->input->post('email_user'));
			$this->session->set_userdata('foto',$foto);

		} else {
			$data['title'] = 'Gagal';
			$data['text'] = 'Profil Gagal Diubah!';
			$data['icon'] = 'error';
		}
		$this->session->set_flashdata($data);
		redirect('dashboard', 'refresh');
	}


	public function tarik_laporan()
	{
		$jenis = $this->input->post('jenis_laporan');
		$kategori = $this->input->post('kategori_laporan');
		$marketing = $this->input->post('nama_marketing_laporan');
		$cabang = $this->input->post('cabang_laporan');
		if ($this->session->level=="Marketing") {
			$cabang = $this->session->cabang;
			$marketing = $this->session->id_user;
		}

		if ($this->session->level=="Supervisor") {
			$cabang = $this->session->cabang;
		}

		$tanggal_awal = $this->input->post('tanggal_awal_laporan');
		$tanggal_akhir = $this->input->post('tanggal_akhir_laporan');

		$data['tanggal_awal'] = $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;

		$data['jenis'] = $jenis;
		if ($kategori=="Potensi Wilayah") {
			if ($jenis=="Marketing") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				if ($marketing!='All') {
					$this->db->where('a.id_user',$marketing);
				}
				if ($this->session->level=="Marketing" || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');
				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();
			}

			if ($jenis=="Cabang") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				if ($cabang!='All') {
					$this->db->where('a.id_cabang',$cabang);
				}
				
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');
				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();
			}

			if ($jenis=="Periode") {
				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang,d.nama_wilayah as kabupaten,e.nama_wilayah as kecamatan, f.nama_wilayah as kelurahan');
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$this->db->join('tbl_master_wilayah d','d.kode_wilayah=a.kabupaten_nasabah');
				$this->db->join('tbl_master_wilayah e','e.sub_wilayah=a.kabupaten_nasabah AND e.kode_wilayah=a.kecamatan_nasabah');
				$this->db->join('tbl_master_wilayah f','f.id_wilayah=a.kelurahan_nasabah');
				$data['laporan'] = $this->db->get('tbl_nasabah a')->result();
			}

			$this->load->view('laporan/draft_laporan_potensi',$data);


		}else{

			if ($jenis=="Marketing") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				if ($marketing!='All') {
					$this->db->where('a.id_user',$marketing);
				}

				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
			}

			if ($jenis=="Cabang") {
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				if ($cabang!='All') {
					$this->db->where('a.id_cabang',$cabang);
				}

				// if ($this->session->level=="Marketing") {
				// 	$this->db->where('a.id_user',$marketing);
				// }
				
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
			}

			if ($jenis=="Periode") {
				if ($this->session->level=="Marketing"  || $this->session->level=="Supervisor") {
					$this->db->where('a.id_cabang',$cabang);
				}
				
				$this->db->select('a.*,b.nama as nama_marketing, c.nama_cabang');
				$this->db->where('date(a.tanggal_input) >=',$tanggal_awal);
				$this->db->where('date(a.tanggal_input) <=',$tanggal_akhir);
				$this->db->join('tbl_master_user b','b.id_user=a.id_user');
				$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
				$data['laporan'] = $this->db->get('tbl_pengajuan a')->result();
			}

			$this->load->view('laporan/draft_laporan_pengajuan',$data);
		}
	}

}
