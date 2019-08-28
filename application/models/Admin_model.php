<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getBarang()
    {
        $query =  $this->db->order_by('id_inventaris','DESC')->get('inventaris');
        return $query->result();
    }
    
    public function getRuang()
    {
        return $this->db->order_by('id_ruang','DESC')->get('ruang')->result();
    }

    public function getUser()
    {
        
        return $this->db->get_where('petugas', ['id_petugas' => $this->session->userdata('user')['id_petugas']])->row_array();

    }
    
}