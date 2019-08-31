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
		
		$data['level'] = strtolower($this->session->userdata('user')['nama_level']);

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/inventaris',
			'templates/footer'
		], $data);
		
	}
	
	// METHOD DETAIL BARANG
	public function detail_barang($kode_inventaris = null, $id_jenis = null)
	{
		if (!$kode_inventaris OR !$id_jenis OR !$this->db->get_where('inventaris', ['kode_inventaris' => $kode_inventaris]) OR !$this->db->get_where('jenis', ['id_jenis' => $id_jenis])){
			redirect('admin/inventaris');
		}

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);
		$data['judul'] = 'Detail barang';
		$data['barang'] = $this->admin->getDetailBarang($kode_inventaris);
		$data['jenis'] = $this->admin->getJenisById($id_jenis);

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/detail-barang',
			'templates/footer'
		], $data);
		
	}

	// METHOD TAMBAH BARANG

	public function tambahData()
	{
		if ($this->admin->addDataBarang($_POST) > 0)
		{
			redirect($this->load->view('smkn2/inventaris'));
		}
	}


	// METHOD EDIT BARANG
	
	
	// METHOD HAPUS BARANG


	// METHOD PEMINJAMAN BARANG

	public function peminjaman()
	{
		admin_logged_in();

		$data['judul'] = 'Peminjaman Barang';

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);

		$data['nama_level'] = strtolower($this->session->userdata('user')['nama_level']);

		$data['peminjam'] = $this->db->get('peminjaman')->result_array();

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
