<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('Pegawai_model', 'pegawai');

	}

	public function index()
	{
		if (!$this->session->userdata('user')) {
			redirect('auth');
        }

        if($this->session->userdata('user')['id_level'] != 3)
        {

            redirect('Forbidden');

        }

		$data['judul'] = 'Pegawai - SMKN 2 BDG';

		$data['user'] = $this->db->get_where('pegawai',['id_pegawai' => $this->session->userdata('user')['id_pegawai']])->row_array();

        $data['nama_user'] = $data['user']['nama_pegawai'];

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/index',
			'templates/footer'
		], $data);

	}

	public function profile()
	{

		$data['judul'] = 'Profile';

		$data['user'] = $this->db->get_where('pegawai', ['id_pegawai' => $this->session->userdata('user')['id_pegawai']])->row_array();

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/profile',
			'templates/footer'
		], $data);

	}

	public function edit_profile()
	{
		$data['judul'] = 'Edit Profile';

		$data['user'] = $this->db->get_where('pegawai', ['id_pegawai' => $this->session->userdata('user')['id_pegawai']])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama tidak boleh kosong']);
		$this->form_validation->set_rules('nip', 'NIP', 'required|is_numeric', [
			'required' => 'NIP tidak boleh kosong',
			'is_numeric' => 'NIP harus berisi angka'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required', ['required' => 'Alamat tidak boleh kosong']);

		if($this->form_validation->run() == false)
		{
			
			view([
				'templates/header',
				'templates/sidebar',
				'templates/topbar',
				'smk2/edit-profile',
				'templates/footer'
			], $data);

		}
		else
		{

			$this->pegawai->edit_profile();

		}


	}
}
