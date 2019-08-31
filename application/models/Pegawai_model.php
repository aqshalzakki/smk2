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

    public function getPegawaiById()
    {

        return $this->db->get_where('pegawai', ['id_pegawai', $this->session->userdata('user')['id_pegawai']])->row_array();

    }


    // Model Peminjaman
    public function peminjamanBarang()
    {

        $kode_barang = htmlspecialchars($this->input->post('kode-barang'));

        $jumlah_barang = htmlspecialchars($this->input->post('jumlah-barang'));

        $inventaris = $this->db->get_where('inventaris', ['kode_inventaris' => (int) $kode_barang])->row_array();

        // Cek apakah kode barang terdaftar
        if($inventaris)
        {

            // Cek apakah stock barang masih ada
            if((int) $inventaris['jumlah'] > 0 OR (int) $inventaris['jumlah'] == 0)
            {

                // Cek apakah jumlah barang lebih besar dari jumlah ketersediaannya
                if((int)$jumlah_barang <= (int)$inventaris['jumlah'])
                {

                    $data = [
                        'jumlah' => (int) $jumlah_barang,
                        'tanggal_pinjam' => time(),
                        'tanggal_kembali' => '-',
                        'status_peminjaman' => 'DIPINJAM',
                        'id_pegawai' => $this->session->userdata('user')['id_pegawai'],
                        'kode_inventaris' => (int) $kode_barang
                    ];

                    $this->db->insert('peminjaman', $data);

                    // Jumlah barang pada tabel INVENTARIS akan berkurang ketika dipinjam

                    $jumlah_akhir = (int) $inventaris['jumlah'] - (int) $jumlah_barang;

                    $this->db->update('inventaris', ['jumlah' => $jumlah_akhir], ['kode_inventaris' => $kode_barang]);

                    message('Peminjaman Berhasil!', 'success', 'pegawai/peminjaman');

                }
                else
                {

                    // Jika jumlah lebih besar maka akan ditampilkan pesan
                    message('Jumlah Barang melebihi batas!', 'danger', 'pegawai/peminjaman');    

                }

            }
            else
            {

                message('Stock barang habis!', 'danger', 'pegawai/peminjaman');

            }
            

        }
        else
        {
            // Jika barang tidak ditemukan maka akan ditampilkan pesan
            message('Kode Barang salah!', 'danger', 'pegawai/peminjaman');

        }

    }
}