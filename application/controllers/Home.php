<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data['buka'] = $this->db->get('pmb')->row_array();
        $data['buka'] = $data['buka']['buka'];
        
        $this->load->view('home/index', $data);
    }
}
