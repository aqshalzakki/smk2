<?php 
    function message($pesan,$tipe,$url)
    {
        $ci = get_instance();
        $ci->session->set_flashdata('message', '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">' . $pesan . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');

        redirect($url);
    }

    function is_invalid($field)
    {

        if(form_error($field))
        {

            return "is-invalid";

        }

        return null;

    }

    function view($view, $data = [])
    {

        $ci = get_instance();

        if(is_array($view))
        {

            $view = array_values($view);

            for ($i=0; $i < count($view); $i++) { 
                
                $ci->load->view($view[$i], $data);

            }

        }
        else
        {

            $ci->load->view($view, $data);

        }

    }

    function file_error($error, $prefix = null, $suffix = null)
    {

        if($error)
        {

            if($prefix != null && $suffix != null)
            {

                return $prefix . $error . $suffix;

            }
            else
            {

                return $error;

            }

        }

    }

    function tampil_error_gambar($prefix = false, $suffix = false)
    {
        $ci = get_instance();
        
        return $ci->upload->display_errors($prefix, $suffix);
    }
    
    function url_home($id_level)
    {
        if ($id_level == 1)
        {
            return base_url();
        }
        return base_url('pegawai');
    }
    
    function admin_logged_in()
    {
        $ci = get_instance();
        
        if (!$ci->session->userdata('user')) {
            redirect('auth');
        }
        
        if ($ci->session->userdata('user')['id_level'] != 1) {
            
            redirect('forbidden');
        }
    }
    
    function pegawai_logged_in()
    {
        $ci = get_instance();

        if (!$ci->session->userdata('user')) {
            redirect('auth');
        }

        if ($ci->session->userdata('user')['id_level'] != 3) {

            redirect('forbidden');
        }
    }

    function cek_tgl_pengembalian($waktu)
    {
        if ($waktu == 0) return '-';

        return date('d F Y', $waktu);
    }
?>