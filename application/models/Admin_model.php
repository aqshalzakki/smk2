<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getBarang()
    {
        return $this->db->order_by('id_inventaris','DESC')->get('inventaris')->result_array();
    }
    
    public function getDetailBarang($kode)
    {
        return $this->db->get_where('inventaris', ['kode_inventaris' => $kode])->row_array();
    }

    public function getJenisById($id_jenis)
    {
        return $this->db->get_where('jenis', ['id_jenis' => $id_jenis])->row_array();
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

    public function addDataBarang($data)
    {
        $data = array(
            'kode_inventaris' => $this->input->post('kodeInventaris'),
            'nama' => $this->input->post('namaBarang'),
            'jumlah' => $this->input->post('jumlah'),
            'kondisi' => $this->input->post('kondisi'),
            'id_jenis' => $this->input->post('jenis'),
            'keterangan' => $this->input->post('keterangan'),
            'tanggal_register' => time(),
            'id_admin' => $this->session->userdata('user')['id_admin']
        );

        $this->db->insert('inventaris', $data);
        message('Data Berhasil ditambahkan','success','admin/inventaris');
    }

}