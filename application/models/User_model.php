<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongo_db');
    }

    public function register($data)
    {
        // Validasi apakah email sudah terdaftar
        $result = $this->mongo_db->where(['email' => $data['email']])->limit(1)->get('users');
        if (!empty($result)) {
            return false; // Jika email sudah ada, kembalikan false
        }

        // Menambahkan `created_at` dengan tanggal sekarang
        $data['created_at'] = new MongoDB\BSON\UTCDateTime();

        // Enkripsi password sebelum disimpan
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        // Simpan data ke MongoDB
        $this->mongo_db->insert('users', $data);
        return true; // Mengembalikan true jika berhasil
    }

    public function login($username, $password)
    {
        // Cari user berdasarkan username
        $result = $this->mongo_db->where(['username' => $username])->limit(1)->get('users');

        if (!empty($result)) {
            // Periksa password
            if (password_verify($password, $result[0]['password'])) {
                return $result[0]; // Login berhasil
            }
        }
        return false; // Login gagal
    }

    public function getUserBySession(){
        $user = $this->session->userdata('user');
        
        if (!empty($user)) {
            $result = $this->mongo_db->where((['email' => $user['email']]))->limit(1)->get('users');
            return $result[0];
        }
    }
}
