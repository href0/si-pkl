<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pkl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('menumodel', 'menu');
        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
    }

    public function index()
    {
        $data = [
            'page'      => 'PKL',
            'sub_page'  => '',
            'content'   => 'pkl/index.php',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_id_login)
        ];
        $this->load->view('template/master', $data);
    }

    public function add()
    {
        $data = [
            'page'      => 'PKL',
            'sub_page'  => 'Permintaan',
            'content'   => 'pkl/form_permintaan',
            'sidebar'   => $this->menu->getMenuOrderByRole('3')
        ];
        $this->load->view('template/master', $data);
    }
}
