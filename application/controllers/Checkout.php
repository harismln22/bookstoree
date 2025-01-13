<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function index()
    {
        $data['title_page'] = 'Checkout';
        $data['user'] = $this->User_model->getUserBySession();
        $data['cart'] = $this->Cart_model->getCartsByUserId($data['user']['_id']->{'$id'});
        $data['cart_items'] = $this->Cart_model->getCartItems($data['cart'][0]['_id']->{'$id'});
        $data['total_price'] = 0;

        foreach ($data['cart_items'] as $item) {
            $data['total_price'] += $item['book']['price'] * $item['quantity'];
        }

        var_dump($data['cart'][0]);
        

        $this->load->view('templates/header', $data);
        $this->load->view('checkout/checkout', $data);
        $this->load->view('templates/footer');
    }
}
