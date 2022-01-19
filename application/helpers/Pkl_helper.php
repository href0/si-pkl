<?php

function is_logged_in($role_id)
{
    // memanggil library CI, agar bisa memakai $this
    $ci = get_instance();

    // jika tidak ada session / ada yang akses paksa melalui url, maka redirect ke auth
    if (!$ci->session->userdata('login_session')) {
        redirect('auth');
    } else {
        //urutan pertama dari url, lihat documentasi CI tentang segment
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('menu', ['url' => $menu])->row_array();

        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('errors');
        }
    }
}
