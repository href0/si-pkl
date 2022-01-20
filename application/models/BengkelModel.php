<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BengkelModel extends CI_Model
{

    public function create($data)
    {
        $this->db->insert('bengkel', $data);

        return $this->db->insert_id();
    }

    public function getAllBengkel()
    {
        return $this->db
            ->select('*')
            ->from('bengkel')
            ->join('user', 'user.user_id = bengkel.user_id')
            ->get()
            ->result_array();
    }

    public function getBengkelById($bengkel_id)
    {
        return $this->db
            ->join('user', 'user.user_id = bengkel.user_id')
            ->where('bengkel_id', $bengkel_id)
            ->get('bengkel')
            ->row_array();
    }

    public function update($data, $user_id)
    {
        return  $this->db->set($data)->where('user_id', $user_id)->update('bengkel');
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
