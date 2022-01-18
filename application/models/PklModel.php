<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PklModel extends CI_Model
{
    public function add($data)
    {
        return $this->db->insert('permintaan_pkl', $data);
    }

    public function getAllPklByBengkelId($bengkel_id)
    {
        return $this->db
            ->join('permintaan_pkl', 'permintaan_pkl.permintaan_pkl_id = pkl.permintaan_pkl_id')
            ->join('siswa', 'siswa.siswa_id = pkl.id_siswa')
            ->where('permintaan_pkl.bengkel_id', $bengkel_id)
            ->get('pkl')
            ->result_array();
    }
}
