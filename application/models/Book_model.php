<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongo_db'); // Pastikan MongoDB sudah terhubung
    }

    public function getBooks($sort_by = null)
    {
        // Tambahkan logika sorting berdasarkan parameter
        if ($sort_by) {
            if ($sort_by == 'price_asc') {
                $this->mongo_db->order_by(['price' => 'ASC']);
            } elseif ($sort_by == 'price_desc') {
                $this->mongo_db->order_by(['price' => 'DESC']);
            } elseif ($sort_by == 'title_asc') {
                $this->mongo_db->order_by(['title' => 'ASC']);
            } elseif ($sort_by == 'title_desc') {
                $this->mongo_db->order_by(['title' => 'DESC']);
            }
        }

        return $this->mongo_db->get('books');
    }

    public function getBooksHome()
    {
        return $this->mongo_db->limit(8)->get('books');
    }

    public function getBookById($id)
    {
        $this->load->library('mongo_db');
        $data = $this->mongo_db->where(['_id' => new MongoDB\BSON\ObjectId($id)])->get('books');
        return $data[0];

    }

    // Fungsi Create Book
    public function createBook($data)
    {
        $this->load->library('mongo_db');
        return $this->mongo_db->insert('books', $data);
    }

    // Fungsi Update Book
    public function updateBook($id, $data)
    {
        $this->load->library('mongo_db');
        return $this->mongo_db
            ->where(['_id' => new MongoDB\BSON\ObjectId($id)])
            ->set($data)
            ->update('books');
    }

    public function updateBookStock($book_id, $new_stock) {
        $this->load->library('mongo_db');
        $this->mongo_db->where(['_id' => new MongoDB\BSON\ObjectId($book_id)])
            ->set(['stock' => $new_stock])
            ->update('books');
    }


    // Fungsi Delete Book
    public function deleteBook($id)
    {
        $this->load->library('mongo_db');
        return $this->mongo_db->where(['_id' => new MongoDB\BSON\ObjectId($id)])->delete('books');
    }


    public function getBookByCartId($id)
    {
        $data = $this->mongo_db->where(['_id' => new MongoDB\BSON\ObjectId($id)])->get('books');
        return $data[0];
    }

    public function searchBooks($field, $keyword, $sort_by = null)
    {
        // Pastikan keyword dicari secara case-insensitive dengan ekspresi reguler
        $regex = new MongoDB\BSON\Regex($keyword, 'i');
        $this->mongo_db->where([$field => $regex]);

        // Tambahkan logika sorting berdasarkan parameter
        if ($sort_by) {
            if ($sort_by == 'price_asc') {
                $this->mongo_db->order_by(['price' => 'ASC']);
            } elseif ($sort_by == 'price_desc') {
                $this->mongo_db->order_by(['price' => 'DESC']);
            } elseif ($sort_by == 'title_asc') {
                $this->mongo_db->order_by(['title' => 'ASC']);
            } elseif ($sort_by == 'title_desc') {
                $this->mongo_db->order_by(['title' => 'DESC']);
            }
        }

        return $this->mongo_db->get('books');
    }

    
}
