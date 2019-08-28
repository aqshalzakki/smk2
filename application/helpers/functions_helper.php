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

    function random_string($length)
    {

        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';

        $string = '';

        for ($i=0; $i < $length; $i++) { 
            
            $pos = rand(0, strlen($karakter) - 1);

            $string .= $karakter{$pos};

        }

        return $string;

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

?>