<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function getMenuOrderByRole($role_id)
    {
        $query = "SELECT `menu`.`id` as `menu_id`, `menu`, `icon`, `url` 
                FROM `menu` JOIN `user_access_menu`
                ON `menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
            ";

        return $this->db->query($query)->result_array();
    }
}
