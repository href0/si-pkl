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

        $this->user_id_login = $this->session->userdata('login_session')['user_id'];
    }

    public function index()
    {
        $bengkel = $this->bengkel->getBengkelByUserId($this->user_id_login);
        $agenda = $this->agenda->getAllAgendaByBengkelId($bengkel['bengkel_id']);
        $data = [
            'page'      => 'Agenda',
            'sub_page'  => '',
            'agenda'    => $agenda,
            'content'   => 'agenda/index',
            'sidebar'   => $this->menu->getMenuOrderByRole($this->user_id_login)
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
                'siswa'         => $this->siswa->getAllSiswa(),
                'type'          => 'add',
                'edit_agenda'   => false,
                'content'       => 'agenda/form',
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_id_login)
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
        $bengkel = $this->bengkel->getBengkelByUserId($this->user_id_login);
        $agenda = $this->agenda->getAgendaByIdAndBengkelId($agenda_id, $bengkel['bengkel_id']);
        if (!$agenda) {
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
                'sidebar'       => $this->menu->getMenuOrderByRole($this->user_id_login)
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