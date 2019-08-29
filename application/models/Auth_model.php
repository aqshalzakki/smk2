<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function login()
    {

        $username = html_escape($this->input->post('username'));
        $password = html_escape($this->input->post('password'));

        $data_pegawai = $this->db->get_where('pegawai', ['username' => $username])->row_array();

        if($data_pegawai)
        {
            if ($password == $data_pegawai['password'])
            {
                $data = [
                    'id_pegawai' => $data_pegawai['id_pegawai'],
                    'id_level' => $data_pegawai['id_level'],
                    'nama_level' => $this->db->get_where('level', ['id_level' => $data_pegawai['id_level']])->row_array()['nama_level'],
                    'nama' => $data_pegawai['nama_pegawai']
                ];

                $role = $this->db->get_where('level', ['id_level' => $data_pegawai['id_level']])->row_array();

                $data['nama_level'] = $role['nama_level'];

                $this->session->set_userdata('user', $data);
                redirect('pegawai');
            }
            else{
                message('Username atau Password salah!','danger','auth');
            }
        }
        else
        {

            $data_admin = $this->db->get_where('admin', ['username' => $username])->row_array();

            if($data_admin)
            {
                if ($password == $data_admin['password']) 
                {
                    
                    $data = [
                        'id_admin' => $data_admin['id_admin'],
                        'id_level' => $data_admin['id_level'],
                        'nama_level' => $this->db->get_where('level', ['id_level' => $data_admin['id_level']])->row_array()['nama_level'],
                        'nama' => $data_admin['nama_admin']
                    ];
                    
                    $this->session->set_userdata('user', $data);

                    redirect('admin');

                } 
                else 
                {

                    message('Username atau Password salah!','danger','auth');

                }

            }
            else
            {

                message('Akun tidak terdaftar!', 'danger', 'auth');

            }

        }

    }

}