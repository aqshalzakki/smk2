<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getPeminjaman()
    {
        return $this->db->get('peminjaman')->result_array();
    }

    // method hapus peminjaman 
    public function hapus_peminjaman_by_id($id)
    {
        $this->db->delete('peminjaman', ['id_peminjaman' => $id]);
        message('Data peminjam berhasil dihapus!', 'success', 'admin/peminjaman');
    }

    public function getBarang()
    {
        return $this->db->order_by('id_inventaris')->get('inventaris')->result_array();
    }
    public function getDetailBarang($kode)
    {
        return $this->db->get_where('inventaris', ['kode_inventaris' => $kode])->row_array();
    }
    public function getPegawai()
    {
        return $this->db->order_by('id_pegawai','DESC')->get('pegawai')->result_array();
    }
    public function getDetailPegawai($data)
    {
        return $this->db->get_where('pegawai', ['id_pegawai' => $data])->row_array();
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

    // Tambah Data
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

    //Edit Data
    public function editData($data)
    {
        
        $kode_inventaris = $data['kodeInventaris'];

        $data = array(
            'kode_inventaris' => $this->input->post('kodeInventaris'),
            'nama' => $this->input->post('namaBarang'),
            'jumlah' => $this->input->post('jumlah'),
            'kondisi' => $this->input->post('kondisi'),
            'id_jenis' => $this->input->post('jenis'),
            'keterangan' => $this->input->post('keterangan'),
            'id_admin' => $this->session->userdata('user')['id_admin']
        );

        $this->db->set($data);
        $this->db->where('kode_inventaris', $kode_inventaris);
        $this->db->update('inventaris');

        message('Data Berhasil Diubah!','success','admin/inventaris');
    }

    // Hapus barang
    public function hapus_barang()
    {

        $this->db->delete('inventaris', ['kode_inventaris' => $this->input->post('kode_inventaris')]);

        message('Data berhasil dihapus', 'success', 'admin/inventaris');

    }

    // Status Peminjam
    public function status_peminjam()
    {

        $status = strtoupper(htmlspecialchars($this->input->post('status')));

        $id_peminjaman = $this->input->post('idPeminjaman');

        $this->db->update('peminjaman', ['status_peminjaman' => $status], ['id_peminjaman' => $id_peminjaman]);

        if($this->db->affected_rows())
        {

            message('Status berhasil diubah', 'success', 'admin/peminjaman');
            
        }
        else
        {

            redirect('admin/peminjaman');

        }


    }

    // METHOD UNTUK JOIN 3 TABEL (PEMINJAMAN,PEGAWAI,INVENTARIS) 
    public function getPeminjamanJoin()
    {
        $peminjaman = $this->getPeminjaman();

        foreach ($peminjaman as $p) :
            $query = "
		SELECT `peminjaman`.`id_peminjaman`, `pegawai`.`nama_pegawai`, `inventaris`.`nama`, `peminjaman`.`jumlah`, `peminjaman`.`tanggal_pinjam`, `peminjaman`.`tanggal_kembali`, `peminjaman`.`status_peminjaman`
		FROM `peminjaman` 
		JOIN `pegawai` ON `peminjaman`.`id_pegawai` = `pegawai`.`id_pegawai`
		JOIN `inventaris` ON `peminjaman`.`kode_inventaris` = `inventaris`.`kode_inventaris`
	";
            $data = $this->db->query($query)->result_array();
        endforeach;
        return $data;
    }

    // METHOD KONFIRMASI PENGEMBALIAN BARANG 
    public function konfirmasi_pengembalian_barang($id_peminjaman)
    {
        $data_peminjaman = $this->db->get_where('peminjaman', ['id_peminjaman' => $id_peminjaman])->row_array();
        
        // pertama cek apakah id/hasil peminjaman ada di database 
        if ($data_peminjaman)
        {
            // pada tabel peminjaman: status peminjaman, tgl kembali akan berubah
            $tgl_kembali = time();
            $status = "SELESAI";

            // lalu update 
            $this->db->set('tanggal_kembali', $tgl_kembali);
            $this->db->set('status_peminjaman', $status);
            $this->db->where('id_peminjaman', $id_peminjaman);
            $this->db->update('peminjaman'); 

            // query ke tabel inventaris untuk mengetahui stok barang terlebih dahulu 
            $kode_inventaris = $data_peminjaman['kode_inventaris'];
            
            $stok_barang = $this->db->get_where('inventaris', ['kode_inventaris' => $kode_inventaris])->row_array()['jumlah'];
            
            
            // pada tabel inventaris : stok akan bertambah kembali seperti semula 
            $jumlah_dipinjam = $data_peminjaman['jumlah'];
            $stok_barang += $jumlah_dipinjam;

            // lalu update ke tabel inventaris

            $this->db->set('jumlah', $stok_barang);
            $this->db->where('kode_inventaris', $kode_inventaris);
            $this->db->update('inventaris');

            // feedback 
            message('Konfirmasi pengembalian barang berhasil!', 'success', 'admin/pengembalian');
        }else{
            redirect('admin/pengembalian');
        }
    }
}