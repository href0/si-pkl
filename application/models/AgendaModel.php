<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AgendaModel extends CI_Model
{
    public function getAllAgendaByBengkelId($bengkel_id)
    {
        return $this->db
            ->join('siswa', 'siswa.siswa_id = agenda.siswa_id')
            ->where('agenda.bengkel_id', $bengkel_id)
            ->get('agenda')
            ->result_array();
    }

    public function getAgendaByIdAndBengkelId($agenda_id, $bengkel_id)
    {
        return $this->db
            ->join('siswa', 'siswa.siswa_id = agenda.siswa_id')
            ->where('agenda.bengkel_id', $bengkel_id)
            ->where('agenda.agenda_id', $agenda_id)
            ->get('agenda')
            ->row_array();
    }
}
