<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BengkelModel extends CI_Model
{
    public function getAllBengkel()
    {
        return $this->db
            ->select('*')
            ->from('bengkel')
            ->join('user', 'user.user_id = bengkel.user_id')
            ->get()
            ->result_array();
    }

    public function getBengkelByUserId($user_id)
    {
        return $this->db
            ->select('*')
            ->from('bengkel')
            ->join('user', 'user.user_id = bengkel.user_id')
            ->where('bengkel.user_id', $user_id)
            ->get()
            ->row_array();;
    }
}
