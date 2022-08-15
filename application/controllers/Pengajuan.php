<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		// if ($this->session->login==FALSE) {

		// 	$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!!! <button type="button" class="close" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</span></button></div>');

		// 	redirect('dashboard','refresh');
		// } 
		date_default_timezone_set('Asia/Jakarta');	
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('pengajuan/tampilan_pengajuan');
		$this->load->view('templates/footer');
	}


	public function tambah_pengajuan($pengajuan=null,$marketing=null)
	{
		$data['marketing'] = $marketing;
		$data['produk'] = $pengajuan;
		$this->db->where('a.id_produk',$pengajuan);
		$this->db->join('tbl_kategori_produk b','b.id_kategori=a.id_kategori','left');
		$kategori = $this->db->get('tbl_master_produk a')->result();

		foreach ($kategori as $key) {
			if (strrpos($key->nama_kategori, 'Kredit')!==false) {
				$this->load->view('pengajuan/pengajuan_kredit',$data); 
			}

			if (strrpos($key->nama_kategori, 'Simpanan')!==false) {
				$this->load->view('pengajuan/pengajuan_simpanan',$data); 
			}

			if (strrpos($key->nama_kategori, 'Lainnya')!==false) {
				$this->load->view('pengajuan/pengajuan_lainnya',$data); 
			}
		}

	}


	public function simpan()
	{


		if (!is_dir('assets/img/foto_pengajuan/')) {
			mkdir('assets/img/foto_pengajuan/');
		}

		$ktp = '';

		if($_FILES['foto_ktp']['name'] != '')
		{
			$filename = trim($_FILES['foto_ktp']['name']);
			$location ='assets/img/foto_pengajuan/ktp'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $location)) {
					$ktp = $location;
				}
			}
		}

		$usaha = '';
		if($_FILES['foto_usaha']['name'] != '')
		{
			$filename = trim($_FILES['foto_usaha']['name']);
			$location ='assets/img/foto_pengajuan/usaha'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['foto_usaha']['tmp_name'], $location)) {
					$usaha = $location;
				}
			}
		}

		$ttd = strval('assets\img\foto_pengajuan\ttd_nasabah'.time().'.png');
		file_put_contents( $ttd, base64_decode( str_replace('data:image/png;base64,','',$this->input->post('isi_ttd') ) ) );


		$this->db->where('id_user',$this->input->post('marketing'));
		$cabang = $this->db->get('tbl_master_user')->result();
		$id_cabang = '';
		
		foreach ($cabang as $key) {
			$id_cabang = $key->id_cabang;
		}

		$kode_pengajuan  = $this->model_pengajuan->buat_kode();
		$data_pengajuan = array(
			'kode_pengajuan' 			=> $kode_pengajuan,
			'nik' 						=> $this->input->post('nik'),
			'nama' 						=> $this->input->post('nama_nasabah'),
			'nama_suami_istri' 			=> $this->input->post('nama_suami_istri'),
			'nama_ibu_kandung' 			=> $this->input->post('nama_ibu_kandung'),
			'alamat_rumah' 				=> $this->input->post('alamat_nasabah'),
			'foto_ktp' 					=> $ktp,
			'nama_usaha_pekerjaan' 		=> $this->input->post('nama_usaha_pekerjaan'),
			'alamat_usaha_pekerjaan' 	=> $this->input->post('alamat_usaha_pekerjaan'),
			'omset_usaha' 				=> str_replace('.','',$this->input->post('omset_usaha')),
			'besar_plafon' 				=> str_replace('.','',$this->input->post('besar_plafon')),
			'foto_usaha' 				=> $usaha,
			'id_cabang' 				=> $id_cabang,
			'id_user' 					=> $this->input->post('marketing'),
			'id_produk' 				=> $this->input->post('produk'),
			'tanggal_input' 			=> date('Y-m-d H:i:s'),
			'status' 					=>	'Nasabah Baru',
			'ttd' 						=>	$ttd,
		);
		$result = $this->db->insert('tbl_pengajuan',$data_pengajuan);
		if ($result) {
			$data['title'] = 'Berhasil';
			$data['text'] = 'Pengajuan Berhasil!<br>Kode Pengajuan Anda : <b> '.$kode_pengajuan.'</b><br> Harap Disimpan';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Pengajuan Gagal, Silahkan Coba Kembali!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('portofolio/portofolio_marketing/'.$this->input->post('marketing'),'refresh');
	}
	public function cetak($kode_pengajuan)
	{
		$this->load->library('dompdf_gen');
		$this->db->where('a.kode_pengajuan',$kode_pengajuan);
		$this->db->join('tbl_master_produk b','b.id_produk=a.id_produk');
		$this->db->join('tbl_master_cabang c','c.id_cabang=a.id_cabang');
		$data['cetak_pengajuan']= $this->db->get('tbl_pengajuan a')->result();
		$this->load->view('pengajuan/cetak',$data); 
		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->load->library('pdfgenerator');
		$this->pdfgenerator->generate_view($html, strtoupper("Pengajuan Nasabah - ".$kode_pengajuan), TRUE, $paper_size, $orientation);
	} 


	public function tolak()
	{
		$this->db->where('kode_pengajuan',$this->input->post('id_pengajuan_tolak'));
		$tolak = $this->db->update('tbl_pengajuan',array('status' => 'Tolak', ));

		if ($tolak) {

			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menolak Pengajuan Nasabah dengan Kode Pengajuan ".$this->input->post('id_pengajuan_tolak'),
			);
			$this->db->insert('tbl_history', $data_history);

			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Pengajuan Berhasil Ditolak!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Pengajuan Gagal Ditolak!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('pengajuan','refresh');

	}

	public function syarat()
	{
		$data = $this->db->get('syarat_ketentuan')->result();
		echo json_encode($data);
	}

	public function tabel_pengajuan(){
		$data   = array();
		$sort     = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'tanggal_input';
		$order    = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'desc';
		$search    = isset($_GET['search']['value']) ? strval($_GET['search']['value']):null;
		$no = $this->input->get('start');

		$list = $this->model_tabel->get_datatables('pengajuan',$sort,$order,$search);

		foreach ($list as $l) {
			$no++;
			$l->no = $no;

			$opsi ='
			<div class="btn-group">
			<a href="javascript:;" class="btn btn-sm btn-circle  btn-success  item_detail_pengajuan" data="'.$l->kode_pengajuan.'"><i class="fa fa-eye"></i></a>';
			if ($l->id_user==$this->session->id_user) {
				if ($l->status!='Realisasi') {

					$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-info  item_follow_up" data="'.$l->kode_pengajuan.'"><i class="fa fa-bullhorn" aria-hidden="true"></i>
					</a>';

				}
				if ($l->status=="Follow UP") {
					$opsi.='<a href="javascript:;" class="btn btn-sm btn-circle  btn-warning  item_realisasi_nasabah" data="'.$l->kode_pengajuan.'"><i class="fa fa-trophy" aria-hidden="true"></i>
					</i>
					</a>';
				}
			}
			// if ($l->status_cabang == 1) {
			// 	$opsi .='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle  item_aktivasi_cabang" data="'.$l->id_cabang.'"><i class="fa fa-times-circle"></i></a>';
			// }else{
			// 	$opsi .='<a href="javascript:;" class="btn btn-success btn-sm btn-circle  item_aktivasi_cabang" data="'.$l->id_cabang.'"><i class="fa fa-check-circle"></i></a>';
			// }
			$opsi .='</div>';
			$l->opsi = $opsi;

			$l->tanggal_input = date_format(date_create($l->tanggal_input),'d-m-Y');

			$l->omset_usaha = number_format($l->omset_usaha,0,",","."); 
			$l->besar_plafon = number_format($l->besar_plafon,0,",","."); 
			$data[] = $l;

		}
		$output = array(
			"draw"              => $_GET['draw'],
			"recordsTotal"      => $this->model_tabel->count_all('pengajuan',$sort,$order,$search),
			"recordsFiltered"   => $this->model_tabel->count_filtered('pengajuan',$sort,$order,$search),
			"data"              => $data,
		);  
		echo json_encode($output); 
	}



	public function realisasi()
	{
		$data_realisasi = array(
			'no_referensi' =>$this->input->post('no_ref'), 
			'tgl_realisasi' =>date('Y-m-d H:i:s'), 
			'status' =>'Realisasi', 
		);

		$this->db->where('kode_pengajuan',$this->input->post('id_nasabah_realisasi'));
		$result= $this->db->update('tbl_pengajuan', $data_realisasi);
		if ($result) {
			$data_fu = array(
				'id_user' =>$this->session->id_user,
				'id_nasabah' =>$this->input->post('id_nasabah_realisasi'), 
				'hasil_fu' =>$this->input->post('no_ref'), 
				'tanggal_fu' =>date('Y-m-d H:i:s'), 
			);

			$result= $this->db->insert('tbl_follow_up', $data_fu);


			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Realisasi Nasabah ".$this->input->post('id_nasabah_realisasi'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Realisasi Berhasil Disimpan!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Realisasi Gagal Disimpan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('pengajuan','refresh');

	}



	public function simpan_fu()
	{
		if (!is_dir('assets/img/foto_fu/')) {
			mkdir('assets/img/foto_fu/');
		}

		$foto = '';

		if($_FILES['lampiran_follow_up']['name'] != '')
		{
			$filename = trim($_FILES['lampiran_follow_up']['name']);
			$location ='assets/img/foto_fu/fu_'.time().$filename;
			$file_extension = pathinfo($location, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$image_ext = array("jpg", "png", "jpeg", "gif");
			if (in_array($file_extension, $image_ext)) {
				if (move_uploaded_file($_FILES['lampiran_follow_up']['tmp_name'], $location)) {
					$foto = $location;
				}
			}
		}
		$data_fu = array(
			'id_user' =>$this->session->id_user,
			'id_nasabah' =>$this->input->post('id_nasabah_follow_up'), 
			'hasil_fu' =>$this->input->post('hasil_follow_up'), 
			'tanggal_fu' =>date('Y-m-d H:i:s'), 
			'lampiran_fu' =>$foto, 
		);

		$result= $this->db->insert('tbl_follow_up', $data_fu);
		if ($result) {
			$this->db->where('kode_pengajuan',$this->input->post('id_nasabah_follow_up'));
			$this->db->update('tbl_pengajuan', array('status' =>'Follow UP'));

			$data_history = array(
				'id_user' => $this->session->id_user, 
				'ip_address'=>get_ip(),
				'aktivitas' => "Menambah Data Follow UP Pengajuan Baru dengan ID Nasabah ".$this->input->post('id_nasabah_follow_up'),
			);
			$this->db->insert('tbl_history', $data_history);
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data Follow UP Berhasil Ditambahkan!';
			$data['icon'] = 'success';
		}else{
			$data['title'] = 'Gagal';
			$data['text'] = 'Data Follow UP Gagal Ditambahkan!';
			$data['icon'] = 'error';
		}	
		$this->session->set_flashdata($data);
		redirect('pengajuan','refresh');
	}

	public function detail_pengajuan()
	{
		$this->db->select('a.*,b.nama as marketing,c.nama_produk');
		$this->db->where('a.kode_pengajuan',$this->input->get('kode_pengajuan'));
		$this->db->join('tbl_master_user b', 'b.id_user=a.id_user','left');
		$this->db->join('tbl_master_produk c', 'c.id_produk=a.id_produk','left');
		$data['pengajuan'] = $this->db->get('tbl_pengajuan a')->result();
		$this->db->select('a.*,b.nama');
		$this->db->where('a.id_nasabah',$this->input->get('kode_pengajuan'));
		$this->db->join('tbl_master_user b','b.id_user=a.id_user');
		$data['follow_up'] = $this->db->get('tbl_follow_up a')->result();
		echo json_encode($data);
	}
	
}