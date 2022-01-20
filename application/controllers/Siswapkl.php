<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswapkl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Model
        $this->load->model('menumodel', 'menu');
        $this->load->model('siswamodel', 'siswa');
        $this->load->model('pembimbingmodel', 'pembimbing');

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
        $this->user_role_login = $this->session->userdata('login_session')['role'];
        $this->username_login = $this->session->userdata('login_session')['username'];
        $this->bengkel_id_login = $this->session->userdata('login_session')['bengkel_id'];
        is_logged_in($this->user_role_login);
    }

    public function index()
    {
        $data = [
            'page'      => 'Siswa PKL',
            'sub_page'  => '',
            'username'  => $this->username_login,
            'table'     => $this->siswa->getAllSiswa(),
            'content'   => 'siswa/index.php',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_role_login)
        ];
        $this->load->view('template/master', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('pembimbing', 'Nama siswa', 'required', [
            'required'  => 'Silahkan pilih pembimbing'
        ]);
        $this->form_validation->set_rules('nama_siswa', 'Nama siswa', 'trim|required', [
            'required'  => 'Nama siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kelas', 'Nama siswa', 'trim|required', [
            'required'  => 'Kelas siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Nama siswa', 'trim|required', [
            'required'  => 'Email siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nohp', 'Nama siswa', 'trim|required', [
            'required'  => 'No handphone siswa tidak boleh kosong'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $data = [
                'page'          => 'Siswa PKL',
                'sub_page'      => 'Tambah',
                'username'      => $this->username_login,
                'type'          => 'add',
                'pembimbing'    => $this->pembimbing->getAllPembimbing(),
                'edit_siswa'    => false,
                'content'       => 'siswa/form',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login)
            ];
            $this->load->view('template/master', $data);
        } else {
            $dataSiswa = [
                'pembimbing_id'        => $this->input->post('pembimbing'),
                'nama_siswa'        => $this->input->post('nama_siswa'),
                'kelas_siswa'       => $this->input->post('kelas'),
                'email_siswa'       => $this->input->post('email'),
                'nohp_siswa'        => $this->input->post('nohp'),
            ];

            $insert = $this->db->insert('siswa', $dataSiswa);

            if ($insert == 1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Siswa PKL berhasil ditambahkan</div>'
                );
                redirect('siswapkl');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
                );
                redirect('siswapkl');
            }
        }
    }

    public function edit($siswa_id = null)
    {

        if (!$siswa_id) {
            redirect('siswapkl');
        }

        $siswa = $this->siswa->getSiswaById($siswa_id);
        if (!$siswa) {
            redirect('siswapkl');
        }


        $this->form_validation->set_rules('nama_siswa', 'Nama siswa', 'trim|required', [
            'required'  => 'Nama siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kelas', 'Nama siswa', 'trim|required', [
            'required'  => 'Kelas siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Nama siswa', 'trim|required', [
            'required'  => 'Email siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nohp', 'Nama siswa', 'trim|required', [
            'required'  => 'No handphone siswa tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'page'          => 'Siswa PKL',
                'sub_page'      => 'Edit',
                'username'      => $this->username_login,
                'type'          => 'edit',
                'pembimbing'    => $this->pembimbing->getAllPembimbing(),
                'edit_siswa'    => $siswa,
                'content'       => 'siswa/form',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login)
            ];
            $this->load->view('template/master', $data);
        } else {
            $dataUpdateSiswa = [
                'nama_siswa'        => $this->input->post('nama_siswa'),
                'kelas_siswa'       => $this->input->post('kelas'),
                'email_siswa'       => $this->input->post('email'),
                'nohp_siswa'        => $this->input->post('nohp'),
            ];
            $update =  $this->db->set($dataUpdateSiswa)->where('siswa_id', $siswa_id)->update('siswa');
            if ($update == 1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Siswa PKL berhasil diupdate</div>'
                );
                redirect('siswapkl');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
                );
                redirect('siswapkl');
            }
        }
    }

    public function delete($siswa_id = null)
    {
        if (!$siswa_id && $this->user_role_login == '3') {
            redirect('err404');
        }

        $siswa = $this->siswa->getSiswaById($siswa_id);
        if (!$siswa) {
            redirect('err404');
        }

        $delete = $this->db->where('siswa_id', $siswa_id)->delete('siswa');
        if ($delete == 1) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Siswa PKL berhasil dihapus</div>'
            );
            redirect('siswapkl');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
            );
            redirect('siswapkl');
        }
    }
}
