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
        $data['title'] = 'Data Nilai';
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
        } else {
            if ($data['cek_data'] > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $data['cek_data'] . ' Data belum dinilai
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">' . ' Semua peserta di tahun ajaran ' . $tahun_ajaran . ' telah dinilai 
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
        $jumlah = $jumlah += 1;

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

        for ($i = 0; $i < count($cek_mahasiswa); $i++) {
            error_reporting(0);
            $where = $keterima[$i]['id'];
            $where1 = $cek_mahasiswa[$i]['id'];
            if ($keterima[$i]['id'] == $cek_mahasiswa[$i]['id']) {
                $sql2 = "UPDATE pendaftar SET pendaftar.id_pengumuman = 1 WHERE pendaftar.id = $where AND pendaftar.id_prodi = $prodi";
                $this->db->query($sql2);
            } else {
                $sql2 = "UPDATE pendaftar SET pendaftar.id_pengumuman = 2 WHERE pendaftar.id = $where1 AND pendaftar.id_prodi = $prodi";
                $this->db->query($sql2);
            }
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Pengumuman berhasi diterbitkan.
      </div>');
        redirect('admin/pengumuman');
    }
    public function data_belum_finalisasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Belum Finalisasi';

        $sql = "SELECT * 
        FROM USER, pendaftar, prodi
        WHERE user.`id` = pendaftar.`id_user_calon_mhs` 
        AND pendaftar.`id_prodi` = prodi.`id`
        AND pendaftar.`status_finalisasi` = 0";

        $data['pendaftar'] = $this->db->query($sql)->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/data_belum_finalisasi', $data);
        $this->load->view('template/footer');
    }
    public function detail_formulir($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Belum Finalisasi';
        $data['judul'] = 'Detail Formulir';

        $sql = "SELECT user.id as id_user, pendaftar.id,pendaftar.`nama_lengkap`, pendaftar.`jalur_seleksi`, prodi.`nama_prodi`, pendaftar.`tempat_lahir`, pendaftar.`tanggal_lahir`, pendaftar.`provinsi_tempat_lahir`, user.`nik`, pendaftar.`jenis_kelamin`, pendaftar.`status_pernikahan`, pendaftar.`agama`, pendaftar.`telepon`, user.`email`, pendaftar.`alamat`, provinsi.`nama_provinsi`, kabupaten.`kabupaten`, kecamatan.`nama_kecamatan`, pendaftar.`kode_pos`, pendaftar.`kewarganegaraan`, pendaftar.`pas_foto`, pendaftar.status_finalisasi, pendaftar.status_validasi_berkas
        FROM user 
        INNER JOIN pendaftar ON user.id = pendaftar.`id_user_calon_mhs`
        INNER JOIN prodi ON prodi.`id` = pendaftar.`id_prodi`
        INNER JOIN provinsi ON pendaftar.`id_provinsi` = provinsi.`id`
        INNER JOIN kabupaten ON kabupaten.`id` = pendaftar.`id_kabupaten`
        INNER JOIN kecamatan ON kecamatan.`id` = pendaftar.`id_kecamatan`
        WHERE user.nik = $id";
        $data['detail_form'] = $this->db->query($sql)->row_array();

        $sql1 = "SELECT user.id,detail_sekolah.`nama_sekolah`, detail_sekolah.`jenis_sekolah`, detail_sekolah.`id_provinsi`, detail_sekolah.`alamat_lengkap_sekolah`, detail_sekolah.`jurusan`, detail_sekolah.`status_kelulusan`, detail_sekolah.`tahun_lulus`, detail_sekolah.`no_ijazah`, detail_sekolah.`tgl_ijazah`, detail_sekolah.`bhs_indonesia`, detail_sekolah.`bhs_inggris`, detail_sekolah.`matematika`, provinsi.`nama_provinsi`
        FROM detail_sekolah, user, provinsi
        WHERE detail_sekolah.`id_user_calon_mhs` = user.`id`
        AND provinsi.`id` = detail_sekolah.`id_provinsi`
        AND user.`nik` = $id";
        $data['detail_sekolah'] = $this->db->query($sql1)->row_array();

        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['provinsi'] = $this->db->get('provinsi')->result_array();
        $data['kabupaten'] = $this->db->get('kabupaten')->result_array();
        $data['kecamatan'] = $this->db->get('kecamatan')->result_array();
        $data['sekolah'] = $this->db->get('sekolah')->result_array();

        $sql2 = "SELECT DISTINCT(sekolah.status) FROM sekolah";
        $data['status_sekolah'] = $this->db->query($sql2)->result_array();

        $sql3 = "SELECT data_prestasi.`id`, user.id as id_user, user.nik, data_prestasi.`jenis_kegiatan_lomba`, data_prestasi.`tingkat_kejuaraan`, data_prestasi.`prestasi_juara_ke`
        FROM data_prestasi, user
        WHERE data_prestasi.`id_user_calon_mhs` = user.`id`";
        $data['data_prestasi'] = $this->db->query($sql3)->result_array();

        $sql4 = "SELECT user.id, user.nik, data_ortu.`nama_ayah`, data_ortu.`pendidikan_terakhir_ayah`, data_ortu.`pekerjaan_ayah`, data_ortu.`penghasilan_ayah`, data_ortu.`nama_ibu`, data_ortu.`pendidikan_terakhir_ibu`, data_ortu.`pekerjaan_ibu`, data_ortu.`penghasilan_ibu`, data_ortu.`alamat_lengkap_ortu`, data_ortu.`id_provinsi_asal_ortu`, data_ortu.`id_kabupaten_ortu`, data_ortu.`kode_pos_ortu`, data_ortu.`telepon_ortu`, data_ortu.`nama_wali`, data_ortu.`pekerjaan_wali`, data_ortu.`alamat_lengkap_wali`, provinsi.`nama_provinsi`, kabupaten.`kabupaten`
        FROM data_ortu, user, provinsi, kabupaten
        WHERE data_ortu.`id_user_calon_mhs` = user.`id`
        AND data_ortu.`id_provinsi_asal_ortu` = provinsi.`id`
        AND data_ortu.`id_kabupaten_ortu` = kabupaten.`id`
        AND user.`nik` = $id";
        $data['data_ortu'] = $this->db->query($sql4)->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/detail_formulir', $data);
        $this->load->view('template/footer');
    }
    public function edit_data_biodata()
    {
        $id = $this->input->post('id');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $jalur_seleksi = $this->input->post('jalur_seleksi');
        $prodi = $this->input->post('prodi');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $provinsi_tempat_lahir = $this->input->post('provinsi_tempat_lahir');
        $nik = $this->input->post('nik');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $status_pernikahan = $this->input->post('status_pernikahan');
        $agama = $this->input->post('agama');
        $no_hp = $this->input->post('no_hp');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat_lengkap');
        $provinsi_tinggal = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $kodepos = $this->input->post('kode_pos');
        $kewarganegaraan = $this->input->post('kewarganegaraan');

        $sql = "UPDATE user, pendaftar
        SET pendaftar.`nama_lengkap` = '$nama_lengkap', pendaftar.`jalur_seleksi` = '$jalur_seleksi', pendaftar.`id_prodi` = $prodi, pendaftar.`tempat_lahir` = '$tempat_lahir', pendaftar.`tanggal_lahir`= '$tgl_lahir',
        pendaftar.provinsi_tempat_lahir = '$provinsi_tempat_lahir', user.nik = $nik, pendaftar.jenis_kelamin = '$jenis_kelamin', pendaftar.status_pernikahan = '$status_pernikahan', pendaftar.agama = '$agama',
        pendaftar.telepon = $no_hp, user.email = '$email', pendaftar.alamat = '$alamat',
        pendaftar.id_provinsi = $provinsi_tinggal, pendaftar.id_kabupaten = $kabupaten,
        pendaftar.id_kecamatan = $kecamatan, pendaftar.kode_pos = $kodepos,
        pendaftar.kewarganegaraan = '$kewarganegaraan'
        WHERE user.id = pendaftar.id_user_calon_mhs
        AND user.id = $id";

        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
        Biodata berhasil diubah.
      </div>');
        redirect('admin/detail_formulir/' . $nik);
    }
    public function edit_data_sekolah()
    {
        $id = $this->input->post('id');
        $nama_sekolah = $this->input->post('nama_sekolah');
        $jenis_sekolah = $this->input->post('jenis_sekolah');
        $provinsi_asal_sekolah = $this->input->post('provinsi_asal_sekolah');
        $alamat_lengkap_sekolah = $this->input->post('alamat_lengkap_sekolah');
        $jurusan = $this->input->post('jurusan');
        $status_kelulusan = $this->input->post('status_kelulusan');
        $tahun_lulus = $this->input->post('tahun_lulus');
        $no_ijazah = $this->input->post('no_ijazah');
        $tgl_ijazah = $this->input->post('tgl_ijazah');
        $bhs_indonesia = $this->input->post('bhs_indonesia');
        $bhs_inggris = $this->input->post('bhs_inggris');
        $matematika = $this->input->post('matematika');

        $nik = $this->input->post('nik');

        $sql = "UPDATE user, detail_sekolah
        SET detail_sekolah.nama_sekolah = '$nama_sekolah', detail_sekolah.jenis_sekolah = '$jenis_sekolah', detail_sekolah.id_provinsi = $provinsi_asal_sekolah, detail_sekolah.alamat_lengkap_sekolah = '$alamat_lengkap_sekolah', detail_sekolah.jurusan='$jurusan', detail_sekolah.status_kelulusan = $status_kelulusan, detail_sekolah.tahun_lulus = $tahun_lulus, detail_sekolah.no_ijazah = '$no_ijazah', detail_sekolah.tgl_ijazah = '$tgl_ijazah', detail_sekolah.bhs_indonesia = $bhs_indonesia, detail_sekolah.bhs_inggris = $bhs_inggris, detail_sekolah.matematika = $matematika
        WHERE user.id = detail_sekolah.id_user_calon_mhs
        AND user.id = $id";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
        Data sekolah berhasil diubah.
      </div>');
        redirect('admin/detail_formulir/' . $nik);
    }
    public function edit_data_prestasi()
    {
        $jenis_kegiatan_lomba = $this->input->post('jenis_kegiatan_lomba');
        $tingkat_kejuaraan = $this->input->post('tingkat_kejuaraan');
        $prestasi_juara_ke = $this->input->post('prestasi_juara_ke');
        $nik = $this->input->post('nik');
        $id = $this->input->post('id');
        $id_user = $this->input->post('id_user');

        // var_dump($jenis_kegiatan_lomba, $tingkat_kejuaraan, $prestasi_juara_ke);
        // die;

        $sql = "UPDATE data_prestasi, user
                SET data_prestasi.jenis_kegiatan_lomba = '$jenis_kegiatan_lomba', data_prestasi.tingkat_kejuaraan = '$tingkat_kejuaraan', data_prestasi.prestasi_juara_ke = '$prestasi_juara_ke'
                WHERE user.id = data_prestasi.id_user_calon_mhs
                AND user.id = $id_user 
                AND data_prestasi.id =$id";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
			Data prestasi berhasil diubah!
		  </div>');
        redirect("admin/detail_formulir/$nik");
    }
    public function edit_data_ortu()
    {
        $id_user = $this->input->post('id');
        $nik = $this->input->post('nik');
        $nama_ayah = $this->input->post('nama_ayah');
        $pendidikan_terakhir_ayah = $this->input->post('pendidikan_terakhir_ayah');
        $pekerjaan_ayah = $this->input->post('pekerjaan_ayah');
        $penghasilan_ayah = $this->input->post('penghasilan_ayah');
        $nama_ibu = $this->input->post('nama_ibu');
        $pendidikan_ibu = $this->input->post('pendidikan_ibu');
        $pekerjaan_ibu = $this->input->post('pekerjaan_ibu');
        $penghasilan_ibu = $this->input->post('penghasilan_ibu');
        $alamat_lengkap_ortu = $this->input->post('alamat_lengkap_ortu');
        $provinsi_asal_orang_tua = $this->input->post('provinsi_asal_orang_tua');
        $kabupaten_asal_orang_tua = $this->input->post('kabupaten_asal_orang_tua');
        $kodepos_alamat_orang_tua = $this->input->post('kodepos_alamat_orang_tua');
        $no_telp_orang_tua = $this->input->post('no_telp_orang_tua');
        $nama_wali = $this->input->post('nama_wali');
        $pekerjaan_wali = $this->input->post('pekerjaan_wali');
        $alamat_lengkap_wali = $this->input->post('alamat_lengkap_wali');

        $sql = "UPDATE data_ortu, user
                SET data_ortu.nama_ayah = '$nama_ayah', data_ortu.pendidikan_terakhir_ayah = '$pendidikan_terakhir_ayah',
                data_ortu.pekerjaan_ayah = '$pekerjaan_ayah', data_ortu.penghasilan_ayah = '$penghasilan_ayah', data_ortu.nama_ibu = '$nama_ibu', data_ortu.pendidikan_terakhir_ibu = '$pendidikan_ibu', data_ortu.pekerjaan_ibu = '$pekerjaan_ibu', data_ortu.penghasilan_ibu = '$penghasilan_ibu', data_ortu.alamat_lengkap_ortu = '$alamat_lengkap_ortu', data_ortu.id_provinsi_asal_ortu = '$provinsi_asal_orang_tua', data_ortu.id_kabupaten_ortu='$kabupaten_asal_orang_tua', data_ortu.kode_pos_ortu = '$kodepos_alamat_orang_tua', data_ortu.telepon_ortu = '$no_telp_orang_tua', data_ortu.nama_wali = '$nama_wali', data_ortu.pekerjaan_wali = '$pekerjaan_wali', data_ortu.alamat_lengkap_wali = '$alamat_lengkap_wali'
                WHERE data_ortu.id_user_calon_mhs = user.id
                AND user.id = $id_user";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
			Data orangtua berhasil diubah!
		  </div>');
        redirect("admin/detail_formulir/$nik");
    }
    public function finalisasi($nik, $id_user, $id)
    {
        $sql = "UPDATE pendaftar, user
                SET pendaftar.status_finalisasi = 1
                WHERE pendaftar.id_user_calon_mhs = user.id
                AND user.id = $id_user
                AND pendaftar.id = $id";
        $this->db->query($sql);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
			Data berhasil difinalisasi!
		  </div>');
        redirect("admin/detail_formulir/$nik");
    }
    public function batal_finalisasi($nik, $id_user, $id)
    {
        $sql = "UPDATE pendaftar, user
                SET pendaftar.status_finalisasi = 0
                WHERE pendaftar.id_user_calon_mhs = user.id
                AND user.id = $id_user
                AND pendaftar.id = $id";
        $this->db->query($sql);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
			Finalisasi berhasil dibatalkan!
		  </div>');
        redirect("admin/detail_formulir/$nik");
    }
    public function status_validasi_berkas($nik, $id_user, $id)
    {
        $sql = "UPDATE pendaftar, user
                SET pendaftar.status_validasi_berkas = 1
                WHERE pendaftar.id_user_calon_mhs = user.id
                AND user.id = $id_user
                AND pendaftar.id = $id";
        $this->db->query($sql);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
			Berkas berhasil divalidasi!
		  </div>');
        redirect("admin/detail_formulir/$nik");
    }
    public function batal_status_validasi_berkas($nik, $id_user, $id)
    {
        $sql = "UPDATE pendaftar, user
                SET pendaftar.status_validasi_berkas = 0
                WHERE pendaftar.id_user_calon_mhs = user.id
                AND user.id = $id_user
                AND pendaftar.id = $id";
        $this->db->query($sql);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
			Validasi berkas dibatalkan!
		  </div>');
        redirect("admin/detail_formulir/$nik");
    }
    public function hapus_prestasi($nik, $id)
    {
        $sql = "DELETE FROM data_prestasi 
                WHERE data_prestasi.id = $id";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-start" role="alert">
        Data berhasil dihapus !
      </div>');
        redirect("admin/detail_formulir/$nik");
    }
}
