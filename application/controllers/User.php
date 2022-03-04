<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('base_model');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'User';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function formulir()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $data['user']['id'];

        $data['provinsi'] = $this->base_model->getDataProv();

        $sesi = $data['user']['role_id'];
        $cek_isi = $data['user']['cek_isi'];

        $sql = "SELECT * FROM th_ajaran WHERE th_ajaran.is_active = 1";

        $data['th_ajaran'] = $this->db->query($sql)->result_array();

        if ($cek_isi == 0 && $sesi == 4) {
            $data['title'] = 'Formulir Pendaftaran';
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/formulir', $data);
            $this->load->view('template/footer');
        } elseif ($cek_isi == 1 && $sesi == 4) {
            $data['title'] = 'Formulir Pendaftaran';

            $sql = "SELECT * 
            FROM user, `pendaftar`, provinsi, kabupaten, kecamatan
            WHERE user.`id` = pendaftar.`id_user_calon_mhs`
            AND pendaftar.id_provinsi = provinsi.id
            AND pendaftar.id_kabupaten = kabupaten.id
            AND pendaftar.id_kecamatan = kecamatan.id
            AND user.role_id = $sesi
            AND user.id = $id_user";

            $data['formulir'] = $this->db->query($sql)->result_array();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/data_formulir', $data);
            $this->load->view('template/footer');
        }
    }
    public function cetak_kartu_test()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $data['user']['id'];
        $this->load->library('dompdf_gen');
        $sql = "SELECT pendaftar.`no_pendaftaran`, pendaftar.`nama_lengkap`, pendaftar.`tempat_lahir`, pendaftar.`tanggal_lahir`, pendaftar.`jenis_kelamin`, prodi.nama_prodi, prodi.ruangan_praktek, prodi.ruangan_wawancara, jadwal.`tgl_test`, pendaftar.pas_foto
        FROM USER, pendaftar, jadwal, prodi
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND jadwal.`id` = pendaftar.`id_jadwal`
        AND prodi.id = pendaftar.`id_prodi`
        AND user.`id` = $id_user";
        $data['kartu_test'] = $this->db->query($sql)->row_array();
        $this->load->view('user/kartu_test', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';

        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('kartu test.pdf', array('Attachment' => 0));
    }
    public function biodata()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $data['user']['id'];
        $sesi = $data['user']['role_id'];
        $this->load->library('dompdf_gen');

        $sql = "SELECT * 
        FROM user, `pendaftar`, provinsi, kabupaten, kecamatan
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND pendaftar.id_provinsi = provinsi.id
        AND pendaftar.id_kabupaten = kabupaten.id
        AND pendaftar.id_kecamatan = kecamatan.id
        AND user.role_id = $sesi
        AND user.id = $id_user";
        $data['biodata'] = $this->db->query($sql)->result_array();
        $this->load->view('user/biodata', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';

        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('biodata.pdf', array('Attachment' => 0));
    }
    public function kabupaten()
    {
        $idprov = $this->input->post('id');
        $data = $this->base_model->getDataKabupaten($idprov);
        $output = '<option value="">Pilih Kabupaten</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->kabupaten . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function kecamatan()
    {
        $idkabupaten = $this->input->post('id');
        $data = $this->base_model->getDataKecamatan($idkabupaten);
        $output = '<option value="" disabled selected>Pilih Kecamatan</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->nama_kecamatan . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function aksi_tambah_formulir()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];
        $nama_lengkap = $this->input->post('nama_lengkap');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $agama = $this->input->post('agama');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $prodi = $this->input->post('prodi');
        $asal_sekolah = $this->input->post('asal_sekolah');
        $tahun_lulus = $this->input->post('tahun_lulus');
        $nama_ortu = $this->input->post('nama_ortu');
        $pekerjaan_ortu = $this->input->post('pekerjaan_ortu');
        $telepon_ortu = $this->input->post('telepon_ortu');
        $tahun_ajaran = $this->input->post('th_ajaran');
        $ktp = $_FILES['ktp'];

        $no_daftar = "PMB-" . rand(0, 1000);


        if ($ktp = '') {
            # code...
        } else {
            $config['upload_path'] = './assets/img/ktp';
            $config['allowed_types'] = 'pdf';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('ktp')) {
                echo "Upload Gagal";
                die();
            } else {
                $ktp = $this->upload->data('file_name');
            }
        }

        $kk = $_FILES['kk'];

        if ($kk = '') {
            # code...
        } else {
            $config['upload_path'] = './assets/img/kk';
            $config['allowed_types'] = 'pdf';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('kk')) {
                echo "Upload Gagal";
                die();
            } else {
                $kk = $this->upload->data('file_name');
            }
        }

        $ijazah = $_FILES['ijazah'];

        if ($ijazah = '') {
            # code...
        } else {
            $config['upload_path'] = './assets/img/ijazah';
            $config['allowed_types'] = 'pdf';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('ijazah')) {
                echo "Upload Gagal";
                die();
            } else {
                $ijazah = $this->upload->data('file_name');
            }
        }

        $pas_foto = $_FILES['pas_foto'];

        if ($pas_foto = '') {
            # code...
        } else {
            $config['upload_path'] = './assets/img/pas_foto';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('pas_foto')) {
                echo "Upload Gagal";
                die();
            } else {
                $pas_foto = $this->upload->data('file_name');
            }
        }

        $id_user_calon_mhs = $data['user']['id'];

        $data = [
            'no_pendaftaran' => $no_daftar,
            'nama_lengkap' => $nama_lengkap,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'agama' => $agama,
            'jenis_kelamin' => $jenis_kelamin,
            'asal_sekolah' => $asal_sekolah,
            'tahun_lulus' => $tahun_lulus,
            'alamat' => $alamat,
            'telepon' => $no_hp,
            'nama_ortu' => $nama_ortu,
            'pekerjaan_ortu' => $pekerjaan_ortu,
            'telepon_ortu' => $telepon_ortu,
            'id_prodi' => $prodi,
            'id_provinsi' => $provinsi,
            'id_kabupaten' => $kabupaten,
            'id_kecamatan' => $kecamatan,
            'id_th_ajaran' => $tahun_ajaran,
            'status_pendaftaran' => NULL,
            'id_pengumuman' => NULL,
            'date_created' => date("Y-m-d"),
            'id_user_calon_mhs' => $id_user_calon_mhs,
            'ktp' => $ktp,
            'kk' => $kk,
            'ijazah' => $ijazah,
            'pas_foto' => $pas_foto
        ];
        $this->db->set($data);
        $this->db->insert('pendaftar');
        $sql3 = "SELECT pendaftar.date_created 
                    FROM pendaftar, user 
                    WHERE user.id = pendaftar.id_user_calon_mhs
                    AND user.id = $id_user_calon_mhs";
        $date_created = $this->db->query($sql3)->row_array();
        $date_created = date('Y-m-d');
        $sql2 = "SELECT jadwal.tgl_berakhir FROM jadwal";
        $id_jadwal = 1;
        $tgl_berakhir = $this->db->query($sql2)->result_array();

        $jumlah_jadwal = count($tgl_berakhir);

        for ($i = 0; $i < $jumlah_jadwal; $i++) {
            if ($date_created > $tgl_berakhir[$i]['tgl_berakhir']) {
                $id_jadwal += 1;
            }
        }

        $sql4 = "UPDATE pendaftar , user 
                    SET pendaftar.id_jadwal = $id_jadwal 
                    WHERE user.id = pendaftar.id_user_calon_mhs
                    AND user.id = $id_user_calon_mhs";

        $this->db->query($sql4);

        $sql = "UPDATE user SET user.cek_isi = 1 WHERE user.id = $id_user_calon_mhs";
        $this->db->query($sql);
        $this->_email($nama_lengkap, $email);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Pendaftaran Berhasil. </div>');
        redirect('user/berhasil_daftar');
    }

    public function _email($nama_lengkap, $email)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'aknsbyogyakarta@gmail.com',
            'smtp_pass' => 'aknsbyogya2014',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->email->initialize($config);
        $this->email->from('aknsbyogyakarta@gmail.com', 'Akademi Komunitas Negeri Seni dan Budaya Yogyakarta');
        $this->email->to($email);
        $this->email->subject('Pendaftaran Berhasil');
        $this->email->message('Hai ' . "$nama_lengkap" . '<br><br><br>
			Selamat anda telah berhasil mendaftar PMB Akademi Komunitas Negeri Seni dan Budaya Yogyakarta<br><br>	
			Berikutnya silahkan unduh kartu test melalui link dibawah ini: <br><br>

			1. Unduh kartu test <a href="' . base_url() . 'sertifikasi/ujian_bahasa' . '">disini</a><br> 
			2. Unduh Formulir <a href="' . base_url() . 'sertifikasi/ujian_bahasa' . '">disini</a><br> 
			
			Terimaksih telah mendaftar penerimaan mahasiswa baru<br><br>
			-Akademi Komunitas Negeri Seni dan Budaya Yogyakarta');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
        }
    }

    public function berhasil_daftar()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Formulir';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/berhasil_daftar', $data);
        $this->load->view('template/footer');
    }
    public function my_profil()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';

        $role_id = $data['user']['role_id'];
        $cek_isi = $data['user']['cek_isi'];

        if ($cek_isi == 0 && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Isi formulir terlebih dahulu ! </div>');
            redirect('user/formulir');
        }

        $sql = "SELECT * 
        FROM user, `pendaftar`
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`";

        $data['pengguna'] = $this->db->query($sql)->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/my_profil', $data);
        $this->load->view('template/footer');
    }
    public function change_password()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Change Password';

        $role_id = $data['user']['role_id'];
        $cek_isi = $data['user']['cek_isi'];

        if ($cek_isi == 0 && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Isi formulir terlebih dahulu ! </div>');
            redirect('user/formulir');
        }

        $this->form_validation->set_rules('current_password', 'Password saat ini', 'required|trim');
        $this->form_validation->set_rules('new_password', 'Password baru', 'required|trim|min_length[6]|matches[konfirmasi_password]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi password', 'required|trim|min_length[6]|matches[new_password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Password saat ini salah !
		  </div>');

                redirect('user/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password baru tidak boleh sama dengan saat ini !
                  </div>');
                    redirect('user/change_password');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil diubah !
                  </div>');
                    redirect('user/change_password');
                }
            }
        }
    }

    public function pengumuman()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pengumuman';

        $role_id = $data['user']['role_id'];
        $cek_isi = $data['user']['cek_isi'];

        if ($cek_isi == 0 && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Isi formulir terlebih dahulu ! </div>');
            redirect('user/formulir');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/pengumuman', $data);
        $this->load->view('template/footer');
    }
}
