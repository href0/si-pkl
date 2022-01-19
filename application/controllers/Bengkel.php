<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bengkel extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('menumodel', 'menu');
        $this->load->model('bengkelmodel', 'bengkel');

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
        $this->user_role_login = $this->session->userdata('login_session')['role'];
        $this->username_login = $this->session->userdata('login_session')['username'];
        $this->bengkel_id_login = $this->session->userdata('login_session')['bengkel_id'];
        is_logged_in($this->user_role_login);
    }


    public function index()
    {

        $data = [
            'page'      => 'Daftar Bengkel',
            'sub_page'  => '',
            'username'  => $this->username_login,
            'bengkel'   => $this->bengkel->getAllBengkel(),
            'content'   => 'bengkel/index',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_role_login)
        ];
        $this->load->view('template/master', $data);
    }
}
