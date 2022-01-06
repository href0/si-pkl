<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Err404 extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('menumodel', 'menu');

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
    }

    public function index()
    {
        $data = [

            'page'      => 'Error 404',
            'sub_page'  => '',
            'content'   => 'err404/index',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_id_login)
        ];
        $this->load->view('template/master', $data);
    }
}
