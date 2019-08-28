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
		

		// var_dump($this->session->userdata('user'));

		$data['judul'] = 'Inventaris - SMKN 2 BDG';

		$data['user'] = $this->db->get_where('petugas',['id_petugas' => $this->session->userdata('user')['id_petugas']])->row_array();

		$data['nama_user'] = $data['user']['nama_petugas'];

		view([
			'templates/header',
			'templates/sidebar',
			'templates/topbar',
			'smk2/index',
			'templates/footer'
		], $data);

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


	public function petugas()
	{

		$data = array (
			'judul' => 'Inventaris - SMKN 2 BDG'
		);

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('smk2/petugas');
		$this->load->view('templates/footer');
		// $this->load->view('smk2/index',$data);
	}

}
