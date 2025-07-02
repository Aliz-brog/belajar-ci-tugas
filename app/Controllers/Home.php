<?php

namespace App\Controllers;
use App\Models\ProductModel; 
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends BaseController
{

        protected $product;
        protected $transaction;
        protected $transaction_detail;

        function __construct()
        {
            helper('number');
            helper('form');
            $this->product = new ProductModel();
            $this->transaction = new TransactionModel();
            $this->transaction_detail = new TransactionDetailModel();
        }

        public function index()
        {
            $product = $this->product->findAll();
            $diskonModel = new \App\Models\DiskonModel();
            $today = date('Y-m-d');
            $diskon = $diskonModel->where('tanggal', $today)->first();
            $nominal_diskon = $diskon ? $diskon['nominal'] : 0;

            // Simpan nominal diskon ke session untuk diakses di header
            if ($nominal_diskon > 0) {
                session()->set('diskon_nominal', $nominal_diskon);
            } else {
                session()->remove('diskon_nominal');
            }

            foreach ($product as &$p) {
                $p['diskon'] = $nominal_diskon;
            }
            $data['product'] = $product;
            $data['pesan_diskon'] = $diskon ? 'Diskon hari ini: ' . number_to_currency($diskon['nominal'], 'IDR') : null;
            return view('v_home', $data);
        }

        public function profile()
{
    $username = session()->get('username');
    $data['username'] = $username;

    $buy = $this->transaction->where('username', $username)->findAll();
    $data['buy'] = $buy;

    $product = [];

    if (!empty($buy)) {
        foreach ($buy as $item) {
            $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

            if (!empty($detail)) {
                $product[$item['id']] = $detail;
            }
        }
    }

    $data['product'] = $product;

    return view('v_profile', $data);
}

        
    
}