<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyeleksi extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Jurusan';
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('penyeleksi/index', $data);
        $this->load->view('template/footer');

    }

    public function detail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Calon Mahasiswa';

        $sql = "SELECT pendaftar.id, pendaftar.`no_pendaftaran`, user.`nik`, pendaftar.`nama_lengkap`, prodi.`nama_prodi`, nilai_test.praktek, nilai_test.wawancara, nilai_test.skor, th_ajaran.tahun_ajaran, pendaftar.id_prodi
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

        $data['tahun_ajaran'] = $this->db->get('th_ajaran')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['data_calon_mahasiswa'] = $this->db->query($sql)->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('penyeleksi/detail', $data);
        $this->load->view('template/footer');
    }

    public function cetak_data_mhs()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Calon Mahasiswa';

        $th_ajaran = $this->input->post('th_ajaran');
        $id_prodi = $this->input->post('prodi');

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
        WHERE nilai_test.skor IS NULL
        AND pendaftar.id_th_ajaran = $th_ajaran
        AND pendaftar.`id_prodi` = $id_prodi
        ";

        $data['data_calon_mahasiswa'] = $this->db->query($sql)->result_array();

        $this->load->view('penyeleksi/cetak_data_mhs', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';

        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('checklist nilai calon mahasiswa.pdf', array('Attachment' => 0));
    }

    public function input_nilai($id_prodi)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $praktek = $this->input->post('praktek');
        $wawancara = $this->input->post('wawancara');
        $id = $this->input->post('id');

        $skor = $praktek + $wawancara;

        $data = [
            'praktek' => $praktek,
            'wawancara' => $wawancara,
            'skor' => $skor,
            'id_pendaftar' => $id
        ];

        $sql = "SELECT count(nilai_test.id) as jumlah
                    FROM nilai_test, pendaftar
                    WHERE nilai_test.id_pendaftar = pendaftar.id
                    AND nilai_test.id_pendaftar = $id";

        $cek_kosong = $this->db->query($sql)->row_array();

        $cek_kosong = $cek_kosong['jumlah'];

        if ($cek_kosong < 1) {
            $this->db->where($id);
            $this->db->set($data);
            $this->db->insert('nilai_test');
        } else {
            $this->db->set('praktek', $praktek);
            $this->db->set('wawancara', $wawancara);
            $this->db->set('skor', $skor);
            $this->db->set('id_pendaftar', $id);
            $this->db->where('id_pendaftar', $id);
            $this->db->update('nilai_test');
        }


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Nilai berhasil diinput.
		  </div>');

        redirect('penyeleksi/detail/'.$id_prodi);
    }
}
