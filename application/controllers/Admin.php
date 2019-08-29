<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('Admin_model', 'admin');

	}

	public function index()
	{
		if (!$this->session->userdata('user')) {
			redirect('auth');
		}

		if($this->session->userdata('user')['id_level'] != 1)
        {

            redirect('Forbidden');

		}
		
		$data['judul'] = 'Inventaris - SMKN 2 BDG';
		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);

		$data['nama_user'] = $data['user']['nama_admin'];

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

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);
		
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

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);

		$this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama tidak boleh kosong']);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required', ['required' => 'Alamat tidak boleh kosong']);

		if ($this->form_validation->run() == false) {

			view([
				'templates/header',
				'templates/sidebar',
				'templates/topbar',
				'smk2/edit-profile',
				'templates/footer'
			], $data);
		} else {

			$this->admin->edit_profile();
		}
	}


	public function data_barang()
	{

		$data['judul'] = 'Data Barang';
		$data['data_barang'] = $this->admin->getBarang();
		
		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/barang',
			'templates/footer'
		], $data);

	}
	
	public function ruang()
	{

        $data = array (
			'judul' => 'Inventaris - SMKN 2 BDG',
			'data_ruang' => $this->admin->getRuang(),
		);

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('smk2/ruang');
		$this->load->view('templates/footer');
		// $this->load->view('smk2/index',$data);
	}


	public function admin()
	{

		$data = array (
			'judul' => 'Inventaris - SMKN 2 BDG'
		);

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('smk2/admin');
		$this->load->view('templates/footer');
		// $this->load->view('smk2/index',$data);
	}

}
