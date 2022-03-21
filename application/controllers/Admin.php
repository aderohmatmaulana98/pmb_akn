<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['title'] = 'Dashboard';
        $data['pmb'] = $this->db->get('pmb')->row_array();
        $data['pmb'] = $data['pmb']['buka'];


        $sql = "SELECT count(id) as jumlah FROM pendaftar";

        $data['pendaftar'] = $this->db->query($sql)->row_array();
        $data['pendaftar'] = $data['pendaftar']['jumlah'];

        $sql1 = "SELECT count(user.`id`) as jumlah
        FROM user, pendaftar, nilai_test, prodi
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND pendaftar.`id` = nilai_test.`id_pendaftar`
        AND pendaftar.`id_prodi` = prodi.`id`
        AND pendaftar.`id_pengumuman` = 1";

        $data['diterima'] = $this->db->query($sql1)->row_array();        
        $data['diterima'] = $data['diterima']['jumlah'];   

        $sql2 = "SELECT count(user.`id`) as jumlah
        FROM user, pendaftar, nilai_test, prodi
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND pendaftar.`id` = nilai_test.`id_pendaftar`
        AND pendaftar.`id_prodi` = prodi.`id`
        AND pendaftar.`id_pengumuman` = 2";

        $data['tidak_lulus'] = $this->db->query($sql2)->row_array();        
        $data['tidak_lulus'] = $data['tidak_lulus']['jumlah'];   
        
        $sql3 = "SELECT count(pendaftar.id) as jumlah
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        AND nilai_test.`skor` IS NULL";

        $data['belum_dinilai'] = $this->db->query($sql3)->row_array();

        $data['belum_dinilai'] = $data['belum_dinilai']['jumlah'];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }

    public function aktivasi()
    {
        $status = $this->input->post('aktif');

        $sql = "UPDATE pmb SET pmb.buka = $status";

        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Status PMB telah diubah !
		  </div>');

            redirect('admin/index');

    }

    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role';
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('template/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role berhasil ditambahkan !
		  </div>');

            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role Access';
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('template/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Akses Di ubah !
		  </div>');
    }
    public function jadwal()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Jadwal PMB';

        $data['jadwal'] = $this->db->get('jadwal')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/jadwal', $data);
            $this->load->view('template/footer');
        }
    }
    public function tambah_jadwal()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $gelombang = $this->input->post('gelombang');
        $tgl_buka = $this->input->post('tgl_buka');
        $tgl_tutup = $this->input->post('tgl_tutup');
        $tgl_test = $this->input->post('tgl_test');
        $status = $this->input->post('status');

        $data = [
            'gelombang' => $gelombang,
            'tgl_buka' => $tgl_buka,
            'tgl_berakhir' => $tgl_tutup,
            'tgl_test' => $tgl_test,
            'is_active' => $status
        ];

        $this->db->insert('jadwal', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Jadwal PMB berhasil ditambahkan.
		  </div>');

        redirect('admin/jadwal');
    }

    public function edit_jadwal()
    {
        $gelombang = $this->input->post('gelombang');
        $tgl_buka = $this->input->post('tgl_buka');
        $tgl_tutup = $this->input->post('tgl_berakhir');
        $tgl_test = $this->input->post('tgl_test');
        $status = $this->input->post('status');
        $id = $this->input->post('id');

        $data = [
            'gelombang' => $gelombang,
            'tgl_buka' => $tgl_buka,
            'tgl_berakhir' => $tgl_tutup,
            'tgl_test' => $tgl_test,
            'is_active' => $status
        ];

        $this->db->where('id', $id);
        $this->db->update('jadwal', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Jadwal PMB berhasil diubah.
		  </div>');

        redirect('admin/jadwal');
    }

    public function delete_jadwal($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jadwal');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Jadwal berhasil dihapus.
      </div>');

        redirect('admin/jadwal');
    }
    
    public function data_calon_mahasiswa()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Data Prodi';
        $data['title'] = 'Data Calon Mahasiswa';
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/data_calon_mahasiswa', $data);
        $this->load->view('template/footer');
    }

    public function detail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Calon Mahasiswa';

        $data['tahun_ajaran'] = $this->db->get('th_ajaran')->result_array();

        $sql = "SELECT pendaftar.`no_pendaftaran`, user.`nik`, pendaftar.`nama_lengkap`, prodi.`nama_prodi`, nilai_test.praktek, nilai_test.wawancara, nilai_test.skor, th_ajaran.tahun_ajaran
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        WHERE prodi.`id` = $id
        ";

        $data['data_calon_mahasiswa'] = $this->db->query($sql)->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('template/footer');
    }

    public function cetak_data_calon_mhs()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Calon Mahasiswa';

        $th_ajaran = $this->input->post('th_ajaran');

        $this->load->library('dompdf_gen');
        $sql = "SELECT pendaftar.`no_pendaftaran`, user.`nik`, pendaftar.`nama_lengkap`, prodi.`nama_prodi`, nilai_test.praktek, nilai_test.wawancara, nilai_test.skor, pendaftar.id_th_ajaran, th_ajaran.tahun_ajaran
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran
        ON pendaftar.`id_th_ajaran` = th_ajaran.id
        WHERE pendaftar.id_th_ajaran = $th_ajaran
        ";

        $data['data_calon_mahasiswa'] = $this->db->query($sql)->result_array();

        $this->load->view('admin/cetak_data_calon_mhs', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';

        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('data calon mahasiswa.pdf', array('Attachment' => 0));
    }

    public function buat_akun_penyeleksi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Buat Akun Penyeleksi';
        $data['penyeleksi'] = $this->db->get_where('user', ['role_id' => 3])->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/buat_akun_penyeleksi', $data);
        $this->load->view('template/footer');
    }
    public function aksi_akun_penyeleksi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $nik = $this->input->post('nik');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = [
            'nik' => $nik,
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'date_created' => time(),
            'image' => 'default.png',
            'is_active' => 1,
            'role_id' => 3
        ];

        $this->db->insert('user', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akun penyeleksi berhasil dibuat.
      </div>');

        redirect('admin/buat_akun_penyeleksi');
    }
    public function delete_penyeleksi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akun Penyeleksi berhasil dihapus.
      </div>');

        redirect('admin/buat_akun_penyeleksi');
    }
    public function tahun_ajaran()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tahun Ajaran';

        $data['tahun_ajaran'] = $this->db->get('th_ajaran')->result_array();

        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/tahun_ajaran', $data);
            $this->load->view('template/footer');
        } else {
            $tahun_ajaran = $this->input->post('tahun_ajaran');
            $status = $this->input->post('status');

            $data = [
                'tahun_ajaran' => $tahun_ajaran,
                'is_active' => $status
            ];

            $this->db->insert('th_ajaran', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Tahun ajaran berhasil ditambahkan.
      </div>');

            redirect('admin/tahun_ajaran');
        }
    }

    public function delete_tahun_ajaran($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('th_ajaran');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Tahun ajaran berhasil dihapus.
      </div>');

        redirect('admin/tahun_ajaran');
    }

    public function pengumuman()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Terbitkan Pengumuman';

        $data['th_ajaran'] = $this->db->get('th_ajaran')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $th_ajaran = $this->input->post('th_ajaran');

        $sql = "SELECT pendaftar.id, pendaftar.`no_pendaftaran`, user.`nik`, pendaftar.`nama_lengkap`, prodi.`nama_prodi`, nilai_test.praktek, nilai_test.wawancara, nilai_test.skor, th_ajaran.tahun_ajaran
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN user
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        AND nilai_test.`skor` IS NULL
        AND `th_ajaran`.`id` = '$th_ajaran'
        ";

        $sql1 = "SELECT COUNT(pendaftar.id) as jumlah
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        AND nilai_test.`skor` IS NULL
        AND `th_ajaran`.`id` = '$th_ajaran'
        ";

        $sql2 = "SELECT `th_ajaran`.`tahun_ajaran`
                    FROM th_ajaran
                    WHERE th_ajaran.id = '$th_ajaran'";

        $tahun_ajaran = $this->db->query($sql2)->row_array();

        $tahun_ajaran = $tahun_ajaran['tahun_ajaran'];


        $data['cek_data'] = $this->db->query($sql1)->row_array();
        $data['cek_data'] = $data['cek_data']['jumlah'];
        
        $data['pengumuman'] = $this->db->query($sql)->result_array();

        $this->form_validation->set_rules('th_ajaran', 'Tahun Ajaran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/pengumuman', $data);
            $this->load->view('template/footer');
        }else {
            if ($data['cek_data']>0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$data['cek_data'].' Data belum dinilai
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">'.' Semua peserta di tahun ajaran '.$tahun_ajaran.' telah dinilai 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            }
    
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/pengumuman', $data);
            $this->load->view('template/footer');
        }
    }
    public function terbit_pengumuman()
    {
        $th_ajaran = $this->input->post('tahun_ajaran');
        $prodi = $this->input->post('prodi');
        $jumlah = $this->input->post('jumlah');
        $jumlah = $jumlah+=1;

        $sql3 = "SELECT COUNT(pendaftar.id) as jumlah
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        AND nilai_test.`skor` IS NULL
        AND `th_ajaran`.`id` = $th_ajaran";

        $data['cek_data'] = $this->db->query($sql3)->row_array();
        $data['cek_data'] = $data['cek_data']['jumlah'];

        if ($data['cek_data'] > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Masih ada peserta yang belum dinilai, silahkan cek kembali!
      </div>');

        redirect('admin/pengumuman');
        }

        $sql = "SELECT pendaftar.id, pendaftar.`no_pendaftaran`, user.`nik`, pendaftar.`nama_lengkap`, prodi.`nama_prodi`, nilai_test.praktek, nilai_test.wawancara, nilai_test.skor, th_ajaran.tahun_ajaran
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        AND nilai_test.`skor` IS NOT NULL
        AND `th_ajaran`.`id` = '$th_ajaran'
        ORDER BY `nilai_test`.`skor` DESC
        LIMIT $jumlah ";

        $keterima = $this->db->query($sql)->result_array();

        $jumlah_keterima = count($keterima);

        if ($jumlah_keterima == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Tidak ada calon mahasiswa pada tahun ajaran tersebut.
      </div>');
      redirect('admin/pengumuman');
        }

        $sql1 = "SELECT pendaftar.id, pendaftar.`no_pendaftaran`, user.`nik`, pendaftar.`nama_lengkap`, prodi.`nama_prodi`, nilai_test.praktek, nilai_test.wawancara, nilai_test.skor, th_ajaran.tahun_ajaran, pendaftar.id_pengumuman
        FROM nilai_test
        RIGHT JOIN pendaftar
        ON pendaftar.`id` = nilai_test.id_pendaftar
        INNER JOIN USER
        ON pendaftar.`id_user_calon_mhs` = user.`id`
        INNER JOIN prodi
        ON pendaftar.`id_prodi` = prodi.`id`
        INNER JOIN th_ajaran 
        ON pendaftar.id_th_ajaran = th_ajaran.id
        AND nilai_test.`skor` IS NOT NULL
        AND `th_ajaran`.`id` = '$th_ajaran'
        ORDER BY `nilai_test`.`skor` DESC";

        $cek_mahasiswa = $this->db->query($sql1)->result_array();

        for ($i=0; $i < count($cek_mahasiswa); $i++) { 
            error_reporting(0);
            $where = $keterima[$i]['id'];
            $where1 = $cek_mahasiswa[$i]['id'];
            if ($keterima[$i]['id'] == $cek_mahasiswa[$i]['id']) {
                $sql2 = "UPDATE pendaftar SET pendaftar.id_pengumuman = 1 WHERE pendaftar.id = $where AND pendaftar.id_prodi = $prodi";
              $this->db->query($sql2);
            }else {
                $sql2 = "UPDATE pendaftar SET pendaftar.id_pengumuman = 2 WHERE pendaftar.id = $where1 AND pendaftar.id_prodi = $prodi";
                $this->db->query($sql2);
            }
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Pengumuman berhasi diterbitkan.
      </div>');
      redirect('admin/pengumuman');
       
    }
}
