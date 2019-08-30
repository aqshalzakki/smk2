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
		admin_logged_in();
		
		$data['judul'] = 'Dashboard';
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

	public function inventaris()
	{
		admin_logged_in();

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);		

		$data['judul'] = 'Inventaris';
		$data['inventaris'] = $this->admin->getBarang();
		
		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/inventaris',
			'templates/footer'
		], $data);
		
	}

	// METHOD PEMINJAMAN BARANG

	public function peminjaman()
	{
		admin_logged_in();

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);

		$data['judul'] = 'Peminjaman Barang';
		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/peminjaman',
			'templates/footer'
		], $data);
	}
	
	
	// -----------------
	
	
	// METHOD PENGEMBALIAN
	public function pengembalian()
	{
		admin_logged_in();

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);		
	
		$data['judul'] = 'Pengembalian Barang';
		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/pengembalian',
			'templates/footer'
		], $data);
	}
	// ----------------


	public function ruang()
	{
		admin_logged_in();
		
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

	public function profile()
	{
		admin_logged_in();
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
		admin_logged_in();
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




}
