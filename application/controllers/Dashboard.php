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

	public function index()
	{

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/tampilan_dashboard');  
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

}
