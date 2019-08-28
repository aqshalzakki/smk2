<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forbidden extends CI_Controller {

    public function index()
    {
        $data['judul'] = '403 Access Forbidden';

        view([
            'templates/header',
            'smk2_errors/error403',
            'templates/footer'
        ], $data);

    }


}