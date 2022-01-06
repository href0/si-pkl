<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends CI_Model
{
    public function getAllSiswa()
    {
        return $this->db->get('siswa')->result_array();
    }
}
