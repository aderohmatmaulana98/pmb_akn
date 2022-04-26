<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/auth_header');
            $this->load->view('auth/index');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        $no_slip = $user['no_slip'];
        $bukti_bayar = $user['bukti_bayar'];

        if ($user) {

            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 2) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 3) {
                        redirect('penyeleksi');
                    } else {
                        if ($user['status_bayar'] == 0) {
                            if ($no_slip != null && $bukti_bayar != null) {
                                redirect('user/tunggu');
                            } else {

                                redirect('user/bayar');
                            }
                        } else {
                            redirect('user/formulir');
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum aktif</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email tidak terdaftar !
		  </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_wa', 'No Whatsapp', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email must unique!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = "Registrasi akun";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('template/auth_footer');
        } else {
            $nama = $this->input->post('fullname', true);
            $email = $this->input->post('email', true);
            $data = [
                'nik' =>  htmlspecialchars($this->input->post('nik', true)),
                'nama_lengkap' => htmlspecialchars($nama),
                'no_whatsapp' => $this->input->post('no_wa', true),
                'email' =>  htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => time(),
                'image' =>  'default.png',
                'is_active' => 0,
                'role_id' => 4,
                'cek_isi' => 0
            ];

            //siapkan token
            $token = base64_encode(openssl_random_pseudo_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);
            $this->db->insert('user', $data);
            $this->_sendEmail($token, 'verify', $nama);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Akun berhasil dibuat, silahkan cek email untuk aktivasi akun!
		  </div>');

            redirect('auth');
        }
    }

    private function _sendEmail($token, $type, $nama)
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
        $this->email->to($this->input->post('email'));
        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik Link Berikut Untuk Reset Password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        } else {
            $this->email->subject('Verifikasi akun');
            $this->email->message('Hai ' . "$nama" . '<br><br><br>
			Selamat anda telah berhasil membuat akun PMB Akademi Komunitas Negeri Seni dan Budaya <br><br><br>			
			Berikutnya silahkan verifikasi akunmu agar dapat login ke halaman web PMB AKNSBY melalui link dibawah ini. <br> 
			Klik Link berikut untuk verifikasi akun : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a> </br><br><br><br>
			Terimaksih telah membuat akun Pendaftaran Mahasiswa Baru AKNSBY<br><br>
			-Akademi Komunitas Negeri Seni dan Budaya Yogyakarata');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . 'Email telah diaktivasi, Silahkan Login !
		 			 </div>');
                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);


                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Aktivasi akun gagal ! , Token Kadaluarsa
		  </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Aktivasi akun gagal ! , Token Salah
		  </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Aktivasi akun gagal ! , Email Salah
		  </div>');
            redirect('auth');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Forgot Password';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('template/auth_footer');
        } else {
            $email = $this->input->post('email');
            $akun_user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($akun_user) {
                $token = base64_encode(openssl_random_pseudo_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot', $email);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Silahkan Cek Email Untuk Reset Password !
		  </div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email Tidak Terdaftar Atau Tidak Aktif !
		  </div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $akun_user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($akun_user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Reset Password Gagal, Token Salah !
		  </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Reset Password Gagal, Email Salah !
		  </div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[6]|matches[password1]');


        if ($this->form_validation->run() == false) {

            $data['title'] = 'Change Password';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('template/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Password Besrhasil Diubah Silahkan Login !
		  </div>');
            redirect('auth');
        }
    }

    public function blocked()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('auth/blocked', $data);
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Logout berhasil
		  </div>');

        redirect('auth');
    }
}
