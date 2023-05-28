<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table      = 'transaksiPengeluaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['namaBarang', 'quantity', 'kontak','pemasok','image'];

    public function transaksi()
    {
        return $this->table('transaksiPengeluaran')
        ->join('stockBarang', 'transaksiPengeluaran.namaBarang = stockBarang.namaBarang')->select('transaksiPengeluaran.id')
        ->select('transaksiPengeluaran.namaBarang')->select('transaksiPengeluaran.quantity')->select('transaksiPengeluaran.pemasok')
        ->select('transaksiPengeluaran.kontak')->select('transaksiPengeluaran.image')->select('transaksiPengeluaran.created_at')
        ->select('stockBarang.hargaBeli')->get()->getResultArray();
    }

    public function pengeluaranBulanan()
    {
        $data = $this->table('transaksiPengeluaran')->join('stockBarang','transaksiPengeluaran.namaBarang = stockBarang.namaBarang')
        ->select('transaksiPengeluaran.quantity')->select('transaksiPengeluaran.created_at')
        ->select('stockBarang.hargaBeli')->select('stockBarang.jenisBarang')->get()->getResultArray();
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
                array_push($januari,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '02') {
                array_push($februari,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '03') {
                array_push($maret,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '04') {
                array_push($april,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '05') {
                array_push($mei,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '06') {
                array_push($juni,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '07') {
                array_push($juli,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '08') {
                array_push($agustus,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '09') {
                array_push($september,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '10') {
                array_push($oktober,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '11') {
                array_push($november,($brg['hargaBeli'])*$brg['quantity']);
            } elseif (substr($brg['created_at'],5,2) == '12') {
                array_push($desember,($brg['hargaBeli'])*$brg['quantity']);
            }
        }
        array_push($array,array_sum($januari),array_sum($februari),array_sum($maret),array_sum($april),array_sum($mei),array_sum($juni),array_sum($juli),array_sum($agustus),array_sum($september),array_sum($oktober),array_sum($november),array_sum($desember));
        return $array;
    }

    public function pengeluaranHarian()
    {
        $data = $this->table('transaksiPengeluaran')->join('stockBarang','transaksiPengeluaran.namaBarang = stockBarang.namaBarang')
        ->select('transaksiPengeluaran.quantity')->select('transaksiPengeluaran.created_at')
        ->select('stockBarang.hargaBeli')->select('stockBarang.jenisBarang')->get()->getResultArray();
        $array = [];
        foreach ($data as $key => $d) {
            if ($d['created_at']==date('Y-m-d')) {
                array_push($array,($d['hargaBeli']*$d['quantity']));
            }
        }
        return $array;
    }
}
