<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

    public function register($username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $user = [
            'username'  => $username,
            'password' => $passwordHash
        ];
        $this->db->insert('user', $user);
    }

    public function getUser($row, $field)
    {
        $check = $this->db
            ->where($row, $field)
            ->get('user');

        return $check->num_rows() > 0 ? $check->row_array() : FALSE;
    }
}
