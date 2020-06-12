<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function index()
    {
        if($this->session->userdata('user'))
        {

            redirect($this->session->userdata('user')['nama_level']);

        }


        $data = [
            'judul' => 'Aplikasi Inventaris SMKN2 Bandung'
        ];

        $this->form_validation->set_rules('username','','trim|required', [
            'required' => 'Username tidak boleh kosong'
        ]);
        
        $this->form_validation->set_rules('password','','trim|required', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == true )  
        {

            $this->auth->login();

        } 
        else 
        {
            $this->load->view('auth_templates/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('auth_templates/footer', $data);
        }
        


    }

    
	public function logout()
	{

		$this->session->unset_userdata('user');
		message('Berhasil logout','success','auth');

	}


}