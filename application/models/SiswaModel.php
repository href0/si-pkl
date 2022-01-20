<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends CI_Model
{
    public function getAllSiswa()
    {
        return $this->db->get('siswa')->result_array();
    }

    public function getSiswaById($siswa_id)
    {
        return $this->db
            ->join('pembimbing', 'pembimbing.pembimbing_id = siswa.pembimbing_id')
            ->where('siswa_id', $siswa_id)
            ->get('siswa')
            ->row_array();
    }
}
