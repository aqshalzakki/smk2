<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    public function get_pegawai_by_nip($nip)
    {
        return $this->db->get_where('pegawai', ['nip' => $nip])->row_array();
    }

    public function edit_profile()
    {
        $nip = $this->input->post('nip');
        $pegawai = $this->get_pegawai_by_nip($nip);

        $data = [
            'nama_pegawai' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        ];

        $nama_gambar = $_FILES['gambar']['name'];
        
        // JIKA USER MENGUPLOAD GAMBAR / FILE
        if ($nama_gambar){
            
            $config['upload_path'] = './vendor/img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '2048';
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('gambar')){
                
                $gambar_lama = $pegawai['gambar'];
                
                // jika gambar lamanya bukan gambar default 
                if ($gambar_lama != 'default.png')
                {
                    // hapus gambar sebelumnya kecuali gambar default
                    unlink(FCPATH . 'vendor/img/' . $gambar_lama);
                }

                $this->db->set('gambar', $nama_gambar);
            }else{

                $this->session->set_flashdata('message', '<small class="text-danger ml-2">File yang anda upload untuk gambar tidak sesuai! (maksimal 2mb)</small>');
                redirect('pegawai/edit_profile');
            }
        }

            $this->db->set('nama_pegawai', $data['nama_pegawai']);
            $this->db->set('alamat', $data['alamat']);

            $this->db->where('nip', $nip);
            $this->db->update('pegawai');

            message('Profile berhasil di ubah!', 'success', 'pegawai/profile');

        
    }
}