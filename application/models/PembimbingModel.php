<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembimbingModel extends CI_Model
{
    public function getAllPembimbing()
    {
        return $this->db->get('pembimbing')->result_array();
    }
}
