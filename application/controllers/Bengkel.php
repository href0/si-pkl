<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bengkel extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('menumodel', 'menu');
        $this->load->model('bengkelmodel', 'bengkel');
        $this->load->model('usermodel', 'user');

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
        $this->user_role_login = $this->session->userdata('login_session')['role'];
        $this->username_login = $this->session->userdata('login_session')['username'];
        $this->bengkel_id_login = $this->session->userdata('login_session')['bengkel_id'];
        is_logged_in($this->user_role_login);
    }


    public function index()
    {

        $data = [
            'page'          => 'Daftar Bengkel',
            'sub_page'      => '',
            'username'      => $this->username_login,
            'bengkel'       => $this->bengkel->getAllBengkel(),
            'content'       => 'bengkel/index',
            'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login)
        ];
        $this->load->view('template/master', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', [
            'required'      => 'Username tidak boleh kosong',
            'is_unique'        => 'Username sudah tedaftar, silahkan buat username lain'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required'      => 'Password tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nama_bengkel', 'bengkel', 'trim|required', [
            'required'      => 'Nama bengkel tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required', [
            'required'      => 'Alamat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[user.email]', [
            'required'      => 'Email tidak boleh kosong',
            'is_unique'        => 'Email sudah tedaftar, silahkan buat email lain'
        ]);
        $this->form_validation->set_rules('nohp', 'Nohp', 'trim|required', [
            'required'      => 'No handphone tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'page'          => 'Daftar Bengkel',
                'sub_page'      => 'Tambah',
                'username'      => $this->username_login,
                'content'       => 'bengkel/form',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login),
                'type'          => 'add',
                'edit_bengkel'  => false,
            ];
            $this->load->view('template/master', $data);
        } else {
            $dataUser = [
                'username'   => $this->input->post('username'),
                'password'   => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'nohp'       => $this->input->post('nohp'),
                'email'      => $this->input->post('email'),
                'alamat'     => $this->input->post('alamat'),
                'user_role'  => '3'
            ];
            $user_id = $this->user->register($dataUser);
            if ($user_id) {
                $dataBengkel = [
                    'user_id'           => $user_id,
                    'nama_bengkel'      => $this->input->post('nama_bengkel'),
                    'alamat_bengkel'    => $this->input->post('alamat'),
                    'status'            => '1'
                ];

                $bengkel = $this->bengkel->create($dataBengkel);
                if ($bengkel) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">Bengkel berhasil ditambahkan</div>'
                    );
                    redirect('bengkel');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
                    );
                    redirect('bengkel');
                }
            }
        }
    }

    public function edit($bengkel_id = null)
    {

        $this->form_validation->set_rules('nama_bengkel', 'bengkel', 'trim|required', [
            'required'      => 'Nama bengkel tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required', [
            'required'      => 'Alamat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'email', 'trim|required', [
            'required'      => 'Email tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nohp', 'Nohp', 'trim|required', [
            'required'      => 'No handphone tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'page'          => 'Daftar Bengkel',
                'sub_page'      => 'Edit',
                'username'      => $this->username_login,
                'type'          => 'edit',
                'edit_bengkel'  => $this->bengkel->getBengkelById($bengkel_id),
                'content'       => 'bengkel/form',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login)
            ];
            $this->load->view('template/master', $data);
        } else {
            $user_id = $this->input->post('user_id');
            $password = $this->input->post('password');
            $checkUser = $this->db->where('user_id !=', $user_id)->get('user')->result_array();
            $checkEmail = 'tidak';
            foreach ($checkUser as $row) {
                if ($row['email'] == $this->input->post('email')) {
                    $checkEmail = 'ada';
                }
            }
            if ($checkEmail == 'ada') {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Email sudah terdaftar</div>'
                );
                redirect('bengkel/edit/' . $bengkel_id);
            }

            $dataUser = [];
            if ($password != '') {
                $dataUser = [
                    'password'   => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'nohp'       => $this->input->post('nohp'),
                    'email'      => $this->input->post('email'),
                    'alamat'     => $this->input->post('alamat'),
                ];
            } else {
                $dataUser = [
                    'nohp'       => $this->input->post('nohp'),
                    'email'      => $this->input->post('email'),
                    'alamat'     => $this->input->post('alamat'),
                ];
            }
            $updateUser = $this->user->update($dataUser, $user_id);
            if ($updateUser > 0) {
                $dataBengkel = [
                    'nama_bengkel'   => $this->input->post('nama_bengkel'),
                    'alamat_bengkel' => $this->input->post('alamat'),
                ];
                $updateBengkel = $this->bengkel->update($dataBengkel, $user_id);
                if ($updateBengkel > 0) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">Bengkel berhasil diupdate</div>'
                    );
                    redirect('bengkel');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
                    );
                    redirect('bengkel');
                }
            }
        }
    }

    public function delete($bengkel_id = null)
    {
        if (!$bengkel_id && $this->user_role_login == '3') {
            redirect('err404');
        }

        $bengkel = $this->bengkel->getBengkelById($bengkel_id);
        if (!$bengkel) {
            redirect('err404');
        }

        $delete = $this->db->where('bengkel_id', $bengkel_id)->delete('bengkel');
        if ($delete == 1) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Bengkel berhasil dihapus</div>'
            );
            redirect('bengkel');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
            );
            redirect('bengkel');
        }
    }
}
