<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menumodel', 'menu');
        $this->load->model('bengkelmodel', 'bengkel');
        $this->load->model('siswamodel', 'siswa');
        $this->load->model('agendamodel', 'agenda');
        $this->load->model('pklmodel', 'pkl');

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
        $this->user_role_login = $this->session->userdata('login_session')['role'];
        $this->username_login = $this->session->userdata('login_session')['username'];
        $this->bengkel_id_login = $this->session->userdata('login_session')['bengkel_id'];


        is_logged_in($this->user_role_login);
    }

    public function index()
    {
        $agenda = '';
        if ($this->user_role_login == '1' || $this->user_role_login == '2') {
            $agenda = $this->agenda->getAllAgenda();
        } else {
            $agenda = $this->agenda->getAllAgendaByBengkelId($this->bengkel_id_login);
        }

        $data = [
            'page'      => 'Agenda',
            'sub_page'  => '',
            'username'  => $this->username_login,
            'role'      => $this->user_role_login,
            'agenda'    => $agenda,
            'content'   => 'agenda/index',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_role_login)
        ];
        $this->load->view('template/master', $data);
    }

    public function add()
    {

        $this->form_validation->set_rules('siswa', 'siswa', 'required', [
            'required'  => 'Silahkan pilih siswa terlebih dahulu'
        ]);
        $this->form_validation->set_rules('tanggal_kegiatan', 'tanggal kegiatan', 'required', [
            'required'  => 'Silahkan pilih tanggal kegiatan terlebih dahulu'
        ]);
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required', [
            'required'  => 'Kegiatan tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nilai_budaya', 'nilai', 'required', [
            'required'  => 'Nilai budaya industri tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'page'          => 'Agenda',
                'sub_page'      => 'Tambah',
                'username'  => $this->username_login,
                'siswa'         => $this->pkl->getAllPklByBengkelId($this->bengkel_id_login),
                'type'          => 'add',
                'edit_agenda'   => false,
                'content'       => 'agenda/form',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login)
            ];
            $this->load->view('template/master', $data);
        } else {

            $bengkel = $this->bengkel->getBengkelByUserId($this->user_id_login);
            $dataAgenda = [
                'bengkel_id'            => $bengkel['bengkel_id'],
                'siswa_id'              => $this->input->post('siswa'),
                'tanggal_kegiatan'      => $this->input->post('tanggal_kegiatan'),
                'kegiatan'              => $this->input->post('kegiatan'),
                'nilai_budaya_industri' => $this->input->post('nilai_budaya'),
            ];

            $insert = $this->db->insert('agenda', $dataAgenda);

            if ($insert == 1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Agenda berhasil ditambahkan</div>'
                );
                redirect('agenda');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
                );
                redirect('agenda');
            }
        }
    }

    public function edit($agenda_id = null)
    {

        if (!$agenda_id) {
            redirect('agenda');
        }
        $bengkel_id = '';
        // jika admin yang login
        if ($this->user_role_login != '3') {
            $bengkel_id = $this->agenda->getAgendaById($agenda_id);
        } else { // jika user biasa
            $bengkel_id = $this->bengkel->getBengkelByUserId($this->user_id_login);
        }
        $agenda = $this->agenda->getAgendaByIdAndBengkelId($agenda_id, $bengkel_id['bengkel_id']);
        if (!$agenda && $this->user_role_login == '3') {
            redirect('agenda');
        }

        $this->form_validation->set_rules('tanggal_kegiatan', 'tanggal kegiatan', 'required', [
            'required'  => 'Silahkan pilih tanggal kegiatan terlebih dahulu'
        ]);
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required', [
            'required'  => 'Kegiatan tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nilai_budaya', 'nilai', 'required', [
            'required'  => 'Nilai budaya industri tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'page'          => 'Agenda',
                'sub_page'      => 'Edit',
                'siswa'         => $this->siswa->getAllSiswa(),
                'edit_agenda'   => $agenda,
                'content'       => 'agenda/form',
                'type'          => 'edit',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_role_login)
            ];
            $this->load->view('template/master', $data);
        } else {
            $dataUpdateAgenda = [
                'tanggal_kegiatan'      => $this->input->post('tanggal_kegiatan'),
                'kegiatan'              => $this->input->post('kegiatan'),
                'nilai_budaya_industri' => $this->input->post('nilai_budaya'),
            ];
            $update =  $this->db->set($dataUpdateAgenda)->where('agenda_id', $agenda_id)->update('agenda');
            if ($update == 1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Agenda berhasil diupdate</div>'
                );
                redirect('agenda');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
                );
                redirect('agenda');
            }
        }
    }

    public function delete($agenda_id = null)
    {
        if (!$agenda_id) {
            redirect('err404');
        }

        // check agenda yang akan dihapus sesuai dengan user yang login
        $bengkel = $this->bengkel->getBengkelByUserId($this->user_id_login);
        $agenda = $this->agenda->getAgendaByIdAndBengkelId($agenda_id, $bengkel['bengkel_id']);
        if (!$agenda) {
            redirect('err404');
        }

        $delete = $this->db->where('agenda_id', $agenda_id)->delete('agenda');
        if ($delete == 1) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Agenda berhasil dihapus</div>'
            );
            redirect('agenda');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Terjadi kesalahan</div>'
            );
            redirect('agenda');
        }
    }
}
