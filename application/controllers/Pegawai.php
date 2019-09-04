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
		pegawai_logged_in();

		$data['judul'] = 'Pegawai - SMKN 2 BDG';

		$data['user'] = $this->db->get_where('pegawai',['id_pegawai' => $this->session->userdata('user')['id_pegawai']])->row_array();

        $data['nama_user'] = $data['user']['nama_pegawai'];

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/profile',
			'templates/footer'
		], $data);

	}

	public function profile()
	{
		pegawai_logged_in();

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
		pegawai_logged_in();
		
		$data['judul'] = 'Edit Profile';

		$data['user'] = $this->db->get_where('pegawai', ['id_pegawai' => $this->session->userdata('user')['id_pegawai']])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama tidak boleh kosong']);
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

	// METHOD PEMINJAMAN BARANG
	
	public function peminjaman()
	{
		pegawai_logged_in();

		$data['judul'] = 'Peminjaman Barang';

		$data['nama_level'] = strtolower($this->session->userdata('user')['nama_level']);

		$data['user'] = $this->db->get_where('pegawai', ['id_pegawai', $this->session->userdata('user')['id_pegawai']])->row_array();

		$this->form_validation->set_rules('kode-barang', '', 'required', [
			'required' => 'Kode Barang tidak boleh kosong'
		]);

		$this->form_validation->set_rules('jumlah-barang', '', 'required|is_numeric', [
			'required' => 'Jumlah Barang tidak boleh kosong',
			'is_numeric' => 'Jumlah Barang harus berisi angka'
		]);

		if($this->form_validation->run() == FALSE)
		{

			view([
				'templates/header',
				'templates/sidebar',
				'templates/topbar',
				'smk2/peminjaman',
				'templates/footer'
			], $data);
			
		}
		else
		{

			$this->pegawai->peminjamanBarang();

		}

	}
	
	
	// -----------------

	

	// METHOD INVENTARIS

	public function inventaris()
	{
		pegawai_logged_in();

		$data['judul'] = 'Inventaris';

		$data['inventaris'] = $this->db->get('inventaris')->result_array();

		$data['level'] = strtolower($this->session->userdata('user')['nama_level']);
		
		$data['user'] = $this->pegawai->getPegawaiById();

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/inventaris',
			'templates/footer'
		], $data);

	}

	// ------------AJAX------------

	// Method untuk AJAX Detail Peminjam
	public function detailPeminjam()
	{

		echo json_encode($this->db->get_where('peminjaman', ['id_peminjaman' => $_POST['idPeminjaman']])->row_array());

	}

	public function barangDiPinjam()
	{

		echo json_encode($this->db->get_where('inventaris', ['kode_inventaris' => $_POST['kode_barang']])->row_array());

	}

	// Method untuk AJAX Peminjaman barang
	public function getBarangByKode()
	{

		if($this->input->post('kodeBarang'))
		{

			$kode_barang = htmlspecialchars($_POST['kodeBarang']);

			$data = $this->db->get_where('inventaris', ['kode_inventaris' => (int) $kode_barang])->row_array();

			if($data)
			{

				echo json_encode($data);

			}
			else
			{

				$data['result'] = "Null";

				echo json_encode($data);

			}

		}
		else
		{

			redirect('pegawai/peminjaman');

		}

	}

}	











