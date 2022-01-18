<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('usermodel', 'user');
    }


    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));
            $user = $this->user->getUser('username', $username);
            if ($user) {
                // check password
                if (password_verify($password, $user['password'])) {
                    if ($user['user_role'] == '1' || $user['user_role'] == '2') {
                        $dataSession = [
                            'role'          => $user['user_role'],
                            'user_id'       => $user['user_id'],
                            'bengkel_id'    => ''
                        ];
                        $this->session->set_userdata('login_session', $dataSession);
                        redirect('bengkel');
                    } else {
                        $bengkel =  $this->db->get_where('bengkel', ['user_id' => $user['user_id']])->row_array();
                        $dataSession = [
                            'role'          => $user['user_role'],
                            'user_id'       => $user['user_id'],
                            'bengkel_id'    => $bengkel['bengkel_id']
                        ];
                        $this->session->set_userdata('login_session', $dataSession);
                        redirect('pkl');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">Password salah</div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Username tidak terdaftar</div>'
                );
                redirect('auth');
            }
        }
    }
}
