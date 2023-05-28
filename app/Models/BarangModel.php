<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'stockBarang';
    protected $useTimestamps = true;
    protected $allowedFields = ['namaBarang', 'jenisBarang', 'hargaJual','hargaBeli','quantity','kontak','image'];

    public function namaBarang()
    {
        $namaBarang = $this->table('stockBarang')->select('stockBarang.namaBarang')->select('stockBarang.jenisBarang')->get()->getResultArray();
        $stockBarang = [];
        foreach ($namaBarang as $key => $nb) {
            array_push($stockBarang,($nb['jenisBarang'] .' ('. $nb['namaBarang']) .')');
        }
        // array_push($stockBarang,'');
        return $stockBarang;    
    }
    public function quantity()
    {
        $quantity = $this->table('stockBarang')->select('stockBarang.quantity')->get()->getResultArray();
        $jumlah = [];
        foreach ($quantity as $key => $q) {
            array_push($jumlah,$q['quantity']);
        }
        // array_push($jumlah,0);
        return $jumlah;    
    }
}
