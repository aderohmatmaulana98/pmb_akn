<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model
{
    public function getSubmenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu
                    FROM user_sub_menu JOIN user_menu
                    ON user_sub_menu.menu_id = user_menu.id";
        return $this->db->query($query)->result_array();
    }
    public function getDataProv()
    {
        return $this->db->get('provinsi')->result_array();
    }
    public function getDataKabupaten($idprov)
    {
        return $this->db->get_where('kabupaten', ['id_provinsi' => $idprov])->result();
    }
    public function getDataKecamatan($idkabupaten)
    {
        return $this->db->get_where('kecamatan', ['id_kabupaten' => $idkabupaten])->result();
    }
}
