<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    // Konstruktor (opsional)
    public function __construct()
    {
        parent::__construct();
        // Pastikan pengguna sudah login jika diperlukan
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('auth/login');
        // }
    }

    public function index()
    {
        // Ambil data pengguna dari session
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');
        
        // Set title page atau data lainnya
        $data['title_page'] = 'Home';
        $data['books'] = $this->Book_model->getBooksHome();
        $data['user'] = $this->User_model->getUserBySession();
        // var_dump($data['user']);

        // Load view dan kirim data ke view
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    // Method untuk generate Snap token Midtrans
    public function generate_snap_token()
    {
        require_once FCPATH . 'config/autoload.php';  // Memastikan autoload.php di-load dengan benar

        \Midtrans\Config::$serverKey = 'SB-Mid-server-o-2ZCD8I2S-_jR8Gp9Gfe_4P';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Ambil cart items dari session atau database
        $cart_items = $this->session->userdata('cart_items') ?? [];
        $item_details = [];
        $total = 0;

        // Menyusun item details
        foreach ($cart_items as $item) {
            $subtotal = $item['book']['price'] * $item['quantity'];
            $total += $subtotal;
            $item_details[] = [
                'id' => $item['book']['_id']->{'$id'},
                'price' => $item['book']['price'],
                'quantity' => $item['quantity'],
                'name' => $item['book']['title']
            ];
        }

        // Menyusun data transaksi
        $transaction_data = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $total,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'customer@example.com',
                'phone' => '081234567890',
            ],
        ];

        try {
            // Meminta token Snap dari Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);

            // Mengirimkan response dalam format JSON
            echo json_encode(['token' => $snapToken]);
        } catch (Exception $e) {
            // Jika terjadi kesalahan, kembalikan pesan error
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
