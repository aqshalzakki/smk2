<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    public function edit_profile()
    {
        $id = $this->session->userdata('user')['id_pegawai'];

        $config['upload_path'] = './vendor/img/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']     = '2048';
        
        $this->load->library('upload', $config);
        
        $data = [
            'nama_pegawai' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'alamat' => $this->input->post('alamat'),
        ];

        if ($this->upload->do_upload('gambar')){

            $data['gambar'] = $this->upload->data('file_name');    
        
        }else{
            
            $data['gambar'] = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array()['gambar'];

        }
            

            $this->db->update('pegawai', $data, ['id_pegawai' => $id]);

            message('Profile berhasil di ubah!', 'success', 'pegawai/profile');

        
    }
}