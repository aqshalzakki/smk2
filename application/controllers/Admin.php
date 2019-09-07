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

		$this->form_validation->set_rules('kodeInventaris', '', 'required|is_numeric', [
			'required' => 'Kode Inventaris tidak boleh kosong',
			'is_numeric' => 'Kode Inventaris harus berisi angka'
		]);

		$this->form_validation->set_rules('namaBarang', '', 'required', [
			'required' => 'Nama Barang tidak boleh kosong'
		]);

		$this->form_validation->set_rules('jumlah', '', 'required|is_numeric', [
			'required' => 'Jumlah Barang tidak boleh kosong',
			'is_numeric' => 'Jumlah Barang harus berisi angka'
		]);

		$this->form_validation->set_rules('kondisi', '', 'required', [
			'required' => 'Kondisi tidak boleh kosong'
		]);

		if($this->form_validation->run() == TRUE)
		{
	
			$this->admin->addDataBarang($this->input->post());

		}
		else
		{

			message(validation_errors(), 'danger', 'admin/inventaris');

		}

	}


	// METHOD EDIT BARANG
	public function getEditData()
	{
		echo json_encode($this->admin->getDetailBarang($_POST['id']));
	}
	

	public function edit_barang()
	{
		$this->admin->editData($this->input->post());
	}
	// --------------------

	// METHOD HAPUS BARANG
	public function hapus_barang()
	{
		if($this->input->post('kode_inventaris'))
		{

			$this->admin->hapus_barang();

		}
		else
		{

			redirect('admin/inventaris');

		}

	}

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
	// METHOD HAPUS DATA PEMINJAMAN 
	public function hapus_peminjaman($id_peminjaman)
	{
		admin_logged_in();

		$this->admin->hapus_peminjaman_by_id($id_peminjaman);
	}
	
	// METHOD PENGEMBALIAN
	public function pengembalian()
	{
		admin_logged_in();
		
		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);
		$data['data'] = $this->admin->getPeminjamanJoin();
		
		$data['judul'] = 'Pengembalian Barang';
		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/pengembalian',
			'templates/footer'
		], $data);
	}
	
	// METHOD KONFIRMASI PENGEMBALIAN 
	public function konfirmasi_pengembalian($id_peminjaman = null)
	{
		if (!$id_peminjaman) redirect('admin/pengembalian');
		admin_logged_in();
		
		$this->admin->konfirmasi_pengembalian_barang($id_peminjaman);
	}
	

	// METHOD PEGAWAI
	public function pegawai()
	{
		admin_logged_in();

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);

		$data['judul'] = 'Data Pegawai';

		$data['pegawai'] = $this->admin->getPegawai();
		
		$data['level'] = strtolower($this->session->userdata('user')['nama_level']);

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/pegawai',
			'templates/footer'
		], $data);
		
	}

	// METHOD DETAIL PEGAWAI
	public function detail_pegawai($id_pegawai = null , $id_level = null)
	{
		admin_logged_in();

		if (!$id_pegawai OR !$id_level OR !$this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai]) OR !$this->db->get_where('level', ['id_level' => $id_level])){
			redirect('admin/pegawai');
		}

		$data['user'] = $this->admin->getAdminById($this->session->userdata('user')['id_admin']);
		$data['judul'] = 'Detail Pegawai';
		$data['pegawai'] = $this->admin->getDetailPegawai($id_pegawai);
		$data['level'] = strtolower($this->session->userdata('user')['nama_level']);

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/detail-pegawai',
			'templates/footer'
		], $data);
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

	// Method Status Detail Peminjam
	public function status_peminjam()
	{

		if($this->input->post('status') AND $this->input->post('idPeminjaman'))
		{

			$this->admin->status_peminjam();

		}
		else
		{

			header("Location: " . __FILE__);

			exit;

		}

	}

	// Method detail peminjam
	public function detailPeminjam()
	{

		echo json_encode($this->db->get_where('peminjaman', ['id_peminjaman' => $_POST['idPeminjaman']])->row_array());

	}

	public function barangDiPinjam()
	{

		echo json_encode($this->db->get_where('inventaris', ['kode_inventaris' => $_POST['kode_barang']])->row_array());

	}


}
