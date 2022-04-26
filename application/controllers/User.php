<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        date_default_timezone_set('Asia/Jakarta');
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

        $role_id = $data['user']['role_id'];

        if ($data['user']['no_slip'] == NULL && $data['user']['bukti_bayar'] == NULL && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Isi bukti bayar terlebih dahulu ! </div>');
            redirect('user/bayar');
        }

        if ($data['user']['no_slip'] != null && $data['user']['bukti_bayar'] != null && $data['user']['status_bayar'] == NULL && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Tunggu verifikasi pembayaran ! </div>');
            redirect('user/tunggu');
        }

        $data['provinsi'] = $this->base_model->getDataProv();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['sekolah'] = $this->db->get('sekolah')->result_array();
        $data['kabupaten_diy'] = $this->db->get('kabupaten_diy')->result_array();

        $sql2 = "SELECT DISTINCT(sekolah.status) FROM sekolah";
        $data['status_sekolah'] = $this->db->query($sql2)->result_array();

        $sesi = $data['user']['role_id'];
        $cek_isi = $data['user']['cek_isi'];

        $sql = "SELECT * FROM th_ajaran WHERE th_ajaran.is_active = 1";

        $data['th_ajaran'] = $this->db->query($sql)->result_array();

        $sql3 = "SELECT user.id AS id_user, user.nik, user.`email`, pendaftar.*, prodi.`nama_prodi`, prodi.`ruangan_praktek`, prodi.`ruangan_wawancara`
        FROM user, pendaftar, prodi
        WHERE user.`id` = pendaftar.`id_user_calon_mhs` 
        AND pendaftar.`id_prodi` = prodi.`id` AND user.id = $id_user";

        $data['pendaftar'] = $this->db->query($sql3)->result_array();


        if ($cek_isi == 0 && $sesi == 4) {
            $data['title'] = 'Formulir Pendaftaran';
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/formulir1', $data);
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
    public function cetak_kartu_test($id, $id_user)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->library('dompdf_gen');
        $sql = "SELECT pendaftar.`no_pendaftaran`, pendaftar.`nama_lengkap`, pendaftar.`tempat_lahir`, pendaftar.`tanggal_lahir`, pendaftar.`jenis_kelamin`, prodi.nama_prodi, prodi.ruangan_praktek, prodi.ruangan_wawancara, jadwal.`tgl_test`, pendaftar.pas_foto, th_ajaran.tahun_ajaran
        FROM user, pendaftar, jadwal, prodi, th_ajaran
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND jadwal.`id` = pendaftar.`id_jadwal`
        AND prodi.id = pendaftar.`id_prodi`
        AND th_ajaran.id = pendaftar.id_th_ajaran
        AND user.`id` = $id_user";
        $data['kartu_test'] = $this->db->query($sql)->row_array();

        $sql1 = "SELECT *
        FROM USER, pendaftar, prodi, provinsi, kabupaten, kecamatan
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND pendaftar.`id_prodi` = prodi.`id`
        AND pendaftar.`id_provinsi` = provinsi.`id`
        AND pendaftar.`id_kabupaten` = kabupaten.`id`
        AND pendaftar.`id_kecamatan` = kecamatan.`id`
        AND user.`id` = $id_user
        AND pendaftar.`id` = $id";

        $data['data_diri'] = $this->db->query($sql1)->row_array();

        $sql4 = "SELECT * 
        FROM user, data_prestasi
        WHERE user.id = data_prestasi.`id_user_calon_mhs`
        AND user.id = $id_user";
        $data['prestasi'] = $this->db->query($sql4)->result_array();

        $sql5 = "SELECT * 
        FROM user, data_ortu, provinsi, kabupaten
        WHERE user.`id` = data_ortu.`id_user_calon_mhs`
        AND data_ortu.`id_provinsi_asal_ortu` = provinsi.`id`
        AND data_ortu.`id_kabupaten_ortu` = kabupaten.`id`
        AND user.`id` = $id_user";
        $data['ortu'] = $this->db->query($sql5)->row_array();

        $sql6 = "SELECT *
        FROM user, detail_sekolah, provinsi
        WHERE user.id = detail_sekolah.`id_user_calon_mhs`
        AND provinsi.`id` = detail_sekolah.`id_provinsi`
        AND user.id = $id_user";
        $data['sekolah'] = $this->db->query($sql6)->row_array();

        $data['surat_pernyataan'] = $this->db->get('surat_pernyataan')->row_array();

        $data['foto'] = $data['kartu_test']['pas_foto'];
        // $this->qrcode($data['foto']);
        $this->load->view('user/kartu_test', $data);
        // $paper_size = 'A4';
        // $orientation = 'potrait';

        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);

        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream('kartu test.pdf', array('Attachment' => 0));
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
    public function sekolah_asal()
    {
        $idkab = $this->input->post('id');
        $data = $this->base_model->getDataSekolah($idkab);
        $output = '<option value="">Pilih Sekolah</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->nama_sekolah . '">' . $row->nama_sekolah . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function kabupaten_asal_orang_tua()
    {
        $idprov = $this->input->post('id');
        $data = $this->base_model->getDataKabupaten($idprov);
        $output = '<option value="">Pilih Kabupaten asal orangtua</option>';
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

        $nama_lengkap = $this->input->post('nama_lengkap');
        $jalur_seleksi = $this->input->post('jalur_seleksi');
        $prodi = $this->input->post('prodi');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $provinsi_tempat_lahir = $this->input->post('provinsi_tempat_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $status_pernikahan = $this->input->post('status_pernikahan');
        $agama = $this->input->post('agama');
        $no_hp = $this->input->post('no_hp');
        $email = $data['user']['email'];
        $alamat = $this->input->post('alamat_lengkap');
        $provinsi_tinggal = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $kodepos = $this->input->post('kode_pos');
        $kewarganegaraan = $this->input->post('kewarganegaraan');
        $no_daftar = "PMB-" . rand(0, 1000);
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

        $sql7 = "SELECT th_ajaran.`id` FROM th_ajaran WHERE th_ajaran.`is_active` = 1";
        $tahun_ajaran = $this->db->query($sql7)->row_array();
        $tahun_ajaran = $tahun_ajaran['id'];

        $data = [
            'no_pendaftaran' => $no_daftar,
            'nama_lengkap' => $nama_lengkap,
            'jalur_seleksi' => $jalur_seleksi,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'provinsi_tempat_lahir' => $provinsi_tempat_lahir,
            'agama' => $agama,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'telepon' => $no_hp,
            'status_pernikahan' => $status_pernikahan,
            'kode_pos' => $kodepos,
            'kewarganegaraan' => $kewarganegaraan,
            'id_prodi' => $prodi,
            'id_provinsi' => $provinsi_tinggal,
            'id_kabupaten' => $kabupaten,
            'id_kecamatan' => $kecamatan,
            'id_th_ajaran' => $tahun_ajaran,
            'id_pengumuman' => NULL,
            'date_created' => date("Y-m-d"),
            'id_user_calon_mhs' => $id_user_calon_mhs,
            'pas_foto' => $pas_foto,
            'status_finalisasi' => 0,
            'status_validasi_berkas' => 0
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

        // $sql = "UPDATE user SET user.cek_isi = 1 WHERE user.id = $id_user_calon_mhs";

        // $this->db->query($sql);
        $sql = "UPDATE user SET user.isi_biodata = 1 WHERE user.id = $id_user_calon_mhs";

        $this->db->query($sql);

        $sql6 = "SELECT pendaftar.pas_foto FROM pendaftar WHERE pendaftar.id_user_calon_mhs = $id_user_calon_mhs";

        $foto = $this->db->query($sql6)->row_array();
        $foto = base_url('assets/img/pas_foto/') . $foto['pas_foto'];

        $this->generate_qrcode($foto, $no_daftar);

        // $this->_email($nama_lengkap, $email);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data diri berhasil disimpan. </div>');
        redirect('user/formulir');
    }
    public function aksi_tambah_sekolah_asal()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $nama_sekolah = $this->input->post('nama_sekolah');
        $nama_sekolah1 = $this->input->post('nama_sekolah1');

        if ($nama_sekolah == 'lainnya') {
            $nama_sekolah2 = $nama_sekolah1;
        } else {
            $nama_sekolah2 = $nama_sekolah;
        }
        $jenis_sekolah = $this->input->post('jenis_sekolah');
        $provinsi_asal_sekolah = $this->input->post('provinsi_asal_sekolah');
        $alamat_lengkap_sekolah = $this->input->post('alamat_lengkap_sekolah');
        $status_kelulusan = $this->input->post('status_kelulusan');
        $jurusan = $this->input->post('jurusan');
        $tahun_lulus = $this->input->post('tahun_lulus');
        $no_ijazah = $this->input->post('no_ijazah');
        $tgl_ijazah = $this->input->post('tgl_ijazah');
        $bhs_indonesia = $this->input->post('bhs_indonesia');
        $bhs_inggris = $this->input->post('bhs_inggris');
        $matematika = $this->input->post('matematika');
        $id_user_calon_mhs = $data['user']['id'];

        $data = [
            'nama_sekolah' => $nama_sekolah2,
            'jenis_sekolah' => $jenis_sekolah,
            'alamat_lengkap_sekolah' => $alamat_lengkap_sekolah,
            'jurusan' => $jurusan,
            'status_kelulusan' => $status_kelulusan,
            'tahun_lulus' => $tahun_lulus,
            'no_ijazah' => $no_ijazah,
            'tgl_ijazah' => $tgl_ijazah,
            'bhs_indonesia' => $bhs_indonesia,
            'bhs_inggris' => $bhs_inggris,
            'matematika' => $matematika,
            'id_user_calon_mhs' => $id_user_calon_mhs,
            'id_provinsi' => $provinsi_asal_sekolah
        ];
        $this->db->set($data);
        $this->db->insert('detail_sekolah');

        $sql = "UPDATE user SET user.isi_sekolah_asal = 1 WHERE user.id = $id_user_calon_mhs";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data sekolah berhasil disimpan. </div>');
        redirect('user/formulir');
    }
    public function aksi_tambah_prestasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $jenis_kegiatan_lomba = $this->input->post('jenis_kegiatan_lomba');
        $tingkat_kejuaraan = $this->input->post('tingkat_kejuaraan');
        $prestasi_juara_ke = $this->input->post('prestasi_juara_ke');
        $id_user_calon_mhs = $data['user']['id'];

        $data = [
            'jenis_kegiatan_lomba' => $jenis_kegiatan_lomba,
            'tingkat_kejuaraan' => $tingkat_kejuaraan,
            'prestasi_juara_ke' => $prestasi_juara_ke,
            'id_user_calon_mhs' => $id_user_calon_mhs
        ];
        $this->db->insert('data_prestasi', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data prestasi berhasil disimpan. </div>');
        redirect('user/formulir');
    }
    public function prestasi_selesai()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user_calon_mhs = $data['user']['id'];
        $sql = "UPDATE user SET user.isi_prestasi = 1 WHERE user.id = $id_user_calon_mhs";
        $this->db->query($sql);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data prestasi telah disimpan. </div>');
        redirect('user/formulir');
    }
    public function aksi_tambah_data_ortu()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user_calon_mhs = $data['user']['id'];

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

        $data = [
            'nama_ayah' => $nama_ayah,
            'pendidikan_terakhir_ayah' => $pendidikan_terakhir_ayah,
            'pekerjaan_ayah' => $pekerjaan_ayah,
            'penghasilan_ayah' => $penghasilan_ayah,
            'nama_ibu' => $nama_ibu,
            'pendidikan_terakhir_ibu' => $pendidikan_ibu,
            'pekerjaan_ibu' => $pekerjaan_ibu,
            'penghasilan_ibu' => $penghasilan_ibu,
            'alamat_lengkap_ortu' => $alamat_lengkap_ortu,
            'id_provinsi_asal_ortu' => $provinsi_asal_orang_tua,
            'id_kabupaten_ortu' => $kabupaten_asal_orang_tua,
            'kode_pos_ortu' => $kodepos_alamat_orang_tua,
            'telepon_ortu' => $no_telp_orang_tua,
            'nama_wali' => $nama_wali,
            'pekerjaan_wali' => $pekerjaan_wali,
            'alamat_lengkap_wali' => $alamat_lengkap_wali,
            'id_user_calon_mhs' => $id_user_calon_mhs
        ];

        $this->db->insert('data_ortu', $data);

        $sql = "UPDATE user SET user.isi_data_ortu = 1 WHERE user.id = $id_user_calon_mhs";
        $this->db->query($sql);
        $sql1 = "UPDATE user SET user.cek_isi = 1 WHERE user.id = $id_user_calon_mhs";
        $this->db->query($sql1);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data orang tua berhasil disimpan. </div>');
        redirect('user/berhasil_daftar');
    }
    public function generate_qrcode($foto, $no_daftar)
    {
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/img/qr_code/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $no_daftar . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $foto; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
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

			1. Unduh kartu test <a href="' . base_url() . 'user/cetak_kartu_test' . '">disini</a><br> 
			2. Unduh Formulir <a href="' . base_url() . 'user/biodata' . '">disini</a><br> 
			
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

        if ($data['user']['no_slip'] != null && $data['user']['bukti_bayar'] != null && $data['user']['status_bayar'] == NULL && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Tunggu verifikasi pembayaran ! </div>');
            redirect('user/tunggu');
        }

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

        if ($data['user']['no_slip'] != null && $data['user']['bukti_bayar'] != null && $data['user']['status_bayar'] == NULL && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Tunggu verifikasi pembayaran ! </div>');
            redirect('user/tunggu');
        }

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
        $user_id = $data['user']['id'];

        if ($data['user']['no_slip'] == NULL && $data['user']['bukti_bayar'] == NULL && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Isi bukti bayar terlebih dahulu ! </div>');
            redirect('user/bayar');
        }

        if ($data['user']['no_slip'] != null && $data['user']['bukti_bayar'] != null && $data['user']['status_bayar'] == NULL && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Tunggu verifikasi pembayaran ! </div>');
            redirect('user/tunggu');
        }

        if ($cek_isi == 0 && $role_id == 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Isi formulir terlebih dahulu ! </div>');
            redirect('user/formulir');
        }

        $sql = "SELECT user.`id`,user.`nik`, pendaftar.`nama_lengkap`, nilai_test.`praktek`, `nilai_test`.`wawancara`, nilai_test.`skor`, pendaftar.id_pengumuman, prodi.`nama_prodi`
        FROM user, pendaftar, nilai_test, prodi
        WHERE user.`id` = pendaftar.`id_user_calon_mhs`
        AND pendaftar.`id` = nilai_test.`id_pendaftar`
        AND pendaftar.`id_prodi` = prodi.`id`
        AND user.`id` = $user_id";

        $data['pengumuman'] = $this->db->query($sql)->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/pengumuman', $data);
        $this->load->view('template/footer');
    }
    public function detail_formulir($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Formulir';

        $sql = "SELECT pendaftar.`nama_lengkap`, pendaftar.`jalur_seleksi`, prodi.`nama_prodi`, pendaftar.`tempat_lahir`, pendaftar.`tanggal_lahir`, pendaftar.`provinsi_tempat_lahir`, user.`nik`, pendaftar.`jenis_kelamin`, pendaftar.`status_pernikahan`, pendaftar.`agama`, pendaftar.`telepon`, user.`email`, pendaftar.`alamat`, provinsi.`nama_provinsi`, kabupaten.`kabupaten`, kecamatan.`nama_kecamatan`, pendaftar.`kode_pos`, pendaftar.`kewarganegaraan`, pendaftar.`pas_foto`
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

        $sql3 = "SELECT data_prestasi.`id`,user.nik, data_prestasi.`jenis_kegiatan_lomba`, data_prestasi.`tingkat_kejuaraan`, data_prestasi.`prestasi_juara_ke`
        FROM data_prestasi, user
        WHERE data_prestasi.`id_user_calon_mhs` = user.`id`";
        $data['data_prestasi'] = $this->db->query($sql3)->result_array();

        $sql4 = "SELECT data_ortu.`nama_ayah`, data_ortu.`pendidikan_terakhir_ayah`, data_ortu.`pekerjaan_ayah`, data_ortu.`penghasilan_ayah`, data_ortu.`nama_ibu`, data_ortu.`pendidikan_terakhir_ibu`, data_ortu.`pekerjaan_ibu`, data_ortu.`penghasilan_ibu`, data_ortu.`alamat_lengkap_ortu`, data_ortu.`id_provinsi_asal_ortu`, data_ortu.`id_kabupaten_ortu`, data_ortu.`kode_pos_ortu`, data_ortu.`telepon_ortu`, data_ortu.`nama_wali`, data_ortu.`pekerjaan_wali`, data_ortu.`alamat_lengkap_wali`, provinsi.`nama_provinsi`, kabupaten.`kabupaten`
        FROM data_ortu, user, provinsi, kabupaten
        WHERE data_ortu.`id_user_calon_mhs` = user.`id`
        AND data_ortu.`id_provinsi_asal_ortu` = provinsi.`id`
        AND data_ortu.`id_kabupaten_ortu` = kabupaten.`id`
        AND user.`nik` = $id";
        $data['data_ortu'] = $this->db->query($sql4)->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/detail_formulir', $data);
        $this->load->view('template/footer');
    }
    public function bayar()
    {
        $data['title'] = 'Pembayaran';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/konfirmasi_pembayaran', $data);
        $this->load->view('template/footer');
    }
    public function aksi_bayar()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $data['user']['id'];
        $no_slip = $this->input->post('no_slip');
        $bukti_bayar = $_FILES['bukti_bayar'];

        if ($bukti_bayar = '') {
            # code...
        } else {
            $config['upload_path'] = './assets/img/bukti_bayar';
            $config['allowed_types'] = 'png|jpg|jpeg|gif';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('bukti_bayar')) {
                echo "Upload Gagal";
                die();
            } else {
                $bukti_bayar = $this->upload->data('file_name');
            }
        }


        $data = [
            'no_slip' => $no_slip,
            'bukti_bayar' => $bukti_bayar,
            'status_bayar' => 0,

        ];

        $sql = "UPDATE user SET user.no_slip='$no_slip', user.bukti_bayar='$bukti_bayar' 
		WHERE user.id=$id_user";

        $this->db->query($sql);


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Bukti bayar berhasil di simpan. </div>');
        redirect('user/tunggu');
    }
    public function tunggu()
    {
        $data['title'] = 'Tunggu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/tunggu', $data);
        $this->load->view('template/footer');
    }
}
