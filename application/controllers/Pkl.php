<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pkl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Model
        $this->load->model('menumodel', 'menu');
        $this->load->model('pklmodel', 'pkl');

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
        $this->user_role_login = $this->session->userdata('login_session')['role'];
        $this->username_login = $this->session->userdata('login_session')['username'];
        $this->bengkel_id_login = $this->session->userdata('login_session')['bengkel_id'];
        is_logged_in($this->user_role_login);
    }

    public function index()
    {

        $data = [
            'title'     => 'PKL',
            'page'      => 'PKL',
            'sub_page'  => '',
            'username'  => $this->username_login,
            'table'     => $this->pkl->getAllPklByBengkelId($this->bengkel_id_login),
            'content'   => 'pkl/index.php',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_role_login)
        ];
        $this->load->view('template/master', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('jumlah_siswa', 'Jumlah', 'trim|required', [
            'required'  => 'Masukkan jumlah siswa'
        ]);
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal', 'trim|required', [
            'required'  => 'Masukkan tanggal masuk'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title'     => 'PKL',
                'page'      => 'PKL',
                'username'  => $this->username_login,
                'sub_page'  => 'Permintaan',
                'content'   => 'pkl/form_permintaan',
                'sidebar'   => $this->menu->getMenuOrderByRole($this->user_role_login)
            ];
            $this->load->view('template/master', $data);
        } else {
            $jumlah_siswa = $this->input->post('jumlah_siswa');
            if ($jumlah_siswa > 10) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maksimal permintaan 10 siswa</div>');
                redirect('pkl/add');
            }
            $data = [
                'bengkel_id'    => $this->bengkel_id_login,
                'jumlah_siswa'  => $this->input->post('jumlah_siswa'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'status'        => 'proses'
            ];
            $insert = $this->pkl->add($data);
            if ($insert > 0) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Permintaan PKL berhasil dikirim, silahkan menunggu konfirmasi dari sekolah maksimal 2x24 Jam</div>'
                );
                redirect('pkl/add');
            }
        }
    }
}
