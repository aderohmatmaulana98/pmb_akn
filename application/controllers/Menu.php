<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Base_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Menu Management';

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/footer');
        } else {
            $menu = $this->input->post('menu');

            $data = [
                'menu' => $menu
            ];

            $this->db->insert('user_menu', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Menu berhasil ditambahkan !
		  </div>');

            redirect('menu');
        }
    }
    public function edit_menu()
    {
        $menu = $this->input->post('menu');
        $id = $this->input->post('id');

        $data = ['menu' => $menu];
        $where = ['id' => $id];

        $this->db->where($where);
        $this->db->update('user_menu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu berhasil diubah !
      </div>');

        redirect('menu');
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu berhasil dihapus !
      </div>');

        redirect('menu');
    }

    public function submenu()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Submenu Management';
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['submenu'] = $this->Base_model->getSubmenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/footer');
        } else {
            $menu_id = $this->input->post('menu');
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $active = $this->input->post('active');

            $data = [
                'menu_id' => $menu_id,
                'title' => $title,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $active
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Submenu berhasil ditambahkan !
		  </div>');

            redirect('menu/submenu');
        }
    }
    public function edit_submenu()
    {
        $title = $this->input->post('title');
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('active');

        $sql = "UPDATE `user_sub_menu`, `user_menu`
                SET `user_sub_menu`.`title` = '$title', `user_sub_menu`.`menu_id` = $menu_id, `user_sub_menu`.`url` = '$url', `user_sub_menu`.`icon` = '$icon', `user_sub_menu`.`is_active` = $is_active
                WHERE `user_menu`.`id` = `user_sub_menu`.`menu_id`
                AND `user_sub_menu`.`id` = $id";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Submenu berhasil di ubah !
					  </div>');
        redirect('menu/submenu');
    }

    public function delete_submenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Submenu berhasil dihapus !
      </div>');

        redirect('menu/submenu');
    }
}
