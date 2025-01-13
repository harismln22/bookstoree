<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $data = [
                'username'   => $this->input->post('username'),
                'full_name'  => $this->input->post('full_name'),
                'email'      => $this->input->post('email'),
                'phone_number' => $this->input->post('phone_number'),
                'address'    => $this->input->post('address'),
                'password'   => $this->input->post('password'),
                'role'       => 'customer',
            ];
    
            // Cek apakah registrasi berhasil
            if ($this->User_model->register($data)) {
                redirect('auth/login'); // Redirect ke halaman login
            } else {
                $this->session->set_flashdata('error', 'Email sudah terdaftar!');
                redirect('auth/register'); // Redirect kembali ke halaman registrasi
            }
        }
    
        $this->load->view('auth/register');
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cek kredensial login
            $user = $this->User_model->login($username, $password);

            if ($user) {
                $this->session->set_userdata('user', $user);
                redirect('home/index'); // Redirect ke halaman dashboard jika berhasil login
                // var_dump($user);
            } else {
                $this->session->set_flashdata('error', 'Login gagal! Cek email dan password Anda.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
