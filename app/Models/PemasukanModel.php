<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasukanModel extends Model
{
    protected $table      = 'transaksiPemasukan';
    protected $useTimestamps = true;
    protected $allowedFields = ['namaBarang', 'quantity','pembeli','kontak','image'];

    public function pemasukanBulanan()
    {
        $data = $this->table('transaksiPemasukan')->join('stockBarang','transaksiPemasukan.namaBarang = stockBarang.namaBarang')
        ->select('transaksiPemasukan.namaBarang')->select('transaksiPemasukan.quantity')->select('transaksiPemasukan.created_at')
        ->select('stockBarang.hargaJual')->select('stockBarang.jenisBarang')->get()->getResultArray();
        $array = [];
        $januari = [];
        $februari = [];
        $maret = [];
        $april = [];
        $mei = [];
        $juni = [];
        $juli = [];
        $agustus = [];
        $september = [];
        $oktober = [];
        $november = [];
        $desember = [];
        foreach ($data as $key => $brg) {
            if (substr($brg['created_at'],5,2) == '01') {
                array_push($januari,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '02') {
                array_push($februari,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '03') {
                array_push($maret,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '04') {
                array_push($april,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '05') {
                array_push($mei,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '06') {
                array_push($juni,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '07') {
                array_push($juli,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '08') {
                array_push($agustus,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '09') {
                array_push($september,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '10') {
                array_push($oktober,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '11') {
                array_push($november,($brg['hargaJual'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '12') {
                array_push($desember,($brg['hargaJual'])*$brg['quantity']);
            }
        }
        array_push($array,array_sum($januari),array_sum($februari),array_sum($maret),array_sum($april),array_sum($mei),array_sum($juni),array_sum($juli),array_sum($agustus),array_sum($september),array_sum($oktober),array_sum($november),array_sum($desember));
        return $array;
    }

    public function pemasukanHarian()
    {
        $data = $this->table('transaksiPemasukan')->join('stockBarang','transaksiPemasukan.namaBarang = stockBarang.namaBarang')
        ->select('transaksiPemasukan.quantity')->select('transaksiPemasukan.created_at')
        ->select('stockBarang.hargaJual')->select('stockBarang.jenisBarang')->get()->getResultArray();
        $array = [];
        foreach ($data as $key => $d) {
            if ($d['created_at']==date('Y-m-d')) {
                array_push($array,($d['hargaJual']*$d['quantity']));
            }
        }
        // dd($array);
        return $array;
    }
}
