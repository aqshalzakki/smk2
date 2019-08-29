<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getBarang()
    {
        $query =  $this->db->order_by('id_inventaris','DESC')->get('inventaris');
        return $query->result_array();
    }
    
    public function getRuang()
    {
        return $this->db->order_by('id_ruang','DESC')->get('ruang')->result();
    }

    public function getAdminById()
    {
        
        return $this->db->get_where('admin', ['id_admin' => $this->session->userdata('user')['id_admin']])->row_array();

    }

    public function edit_profile()
    {
        $id_admin = $this->input->post('id_admin');
        $admin = $this->getAdminById($id_admin);

        $data = [
            'nama_admin' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        ];

        $nama_gambar = $_FILES['gambar']['name'];

        // JIKA USER MENGUPLOAD GAMBAR / FILE
        if ($nama_gambar) {

            $config['upload_path'] = './vendor/img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {

                $gambar_lama = $admin['gambar'];

                // jika gambar lamanya bukan gambar default 
                if ($gambar_lama != 'default.png') {
                    // hapus gambar sebelumnya kecuali gambar default
                    unlink(FCPATH . 'vendor/img/' . $gambar_lama);
                }

                $this->db->set('gambar', $nama_gambar);
            } else {

                $this->session->set_flashdata('message', '<small class="text-danger ml-2">File yang anda upload untuk gambar tidak sesuai! (maksimal 2mb)</small>');
                redirect('admin/edit_profile');
            }
        }

        $this->db->set('nama_admin', $data['nama_admin']);
        $this->db->set('alamat', $data['alamat']);

        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin');

        message('Profile berhasil di ubah!', 'success', 'admin/profile');
    }
}