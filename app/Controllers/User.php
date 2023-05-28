<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\BarangModel;
use \App\Models\PemasukanModel;
use \App\Models\PengeluaranModel;

class User extends BaseController
{
    protected $UserModel;
    protected $BarangModel;
    protected $PemasukanModel;
    protected $PengeluaranModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->BarangModel = new BarangModel();
        $this->PemasukanModel = new PemasukanModel();
        $this->PengeluaranModel = new PengeluaranModel();
        if (session('username') == null) {
            session()->setFlashdata('danger', 'Harap Login terlebih dahulu');
            header('Location: ' . base_url(''));
            exit();
        } 
    }
    public function pemasukan()
    {
        $data = [
            'title'         => 'Pemasukan',
            'barang'        => $this->BarangModel->findAll(),
            'pemasukan'     => $this->PemasukanModel->findAll(),
            'user'          => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        // dd($data);
        return view('User/pemasukan', $data);
    }
    public function pengeluaran()
    {
        $data = [
            'title'         => 'Pengeluaran',
            'breadcrumb'    => ['Pengeluaran'],
            'transaksi'     => $this->PengeluaranModel->transaksi(),
            'user'          => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('User/pengeluaran', $data);
    }
    public function pengeluaran_()
    {
        $pemasok = $this->request->getVar('pemasok');
        $quantity = $this->request->getVar('quantity');
        $kontak = $this->request->getVar('kontak');
        $namaBarang = $this->request->getVar('namaBarang');
        $getImage = $this->request->getFile('image');

        $barang = $this->BarangModel->where(['namaBarang'=> $namaBarang])->first();

        $jumlah = $barang['quantity'] + $quantity;

        $upload = $getImage->getName();
        // beri penamaan
        $upload = date('d-m-Y') . '_' . $upload;
        // move image
        $getImage->move('img/buktiPengeluaran',$upload);
        

        $this->PengeluaranModel->save([
            'namaBarang'        => $namaBarang,
            'quantity'          => $quantity,
            'pemasok'           => $pemasok,
            'image'             => $upload,
            'kontak'            => $kontak,
        ]);

        $this->BarangModel->save([
            'id'        =>  $barang['id'],
            'quantity'  =>  $jumlah
        ]);
        return redirect()->to('User/pengeluaran');
    }

    public function pemasukan_()
    {
        $namaBarang = $this->request->getVar('namaBarang');
        $jumlah = $this->request->getVar('quantity');
        $pembeli = $this->request->getVar('pembeli');
        $kontak = $this->request->getVar('kontak');
        $getImage = $this->request->getFile('image');

        $barang = $this->BarangModel->where(['namaBarang'=> $namaBarang] )->first();
        $quantity = $barang['quantity'] - $jumlah;

        $upload = $getImage->getName();
        // beri penamaan
        $upload = date('d-m-Y') . '_' . $upload;
        // move image
        $getImage->move('img/buktiPemasukan',$upload);
        $this->PemasukanModel->save([
            'namaBarang'    => $namaBarang,
            'quantity'      => $jumlah,
            'pembeli'       => $pembeli,
            'kontak'        => $kontak,
            'hargaJual'     => $barang['hargaJual'],
            'image'         => $upload
        ]);

        $this->BarangModel->save([
            'id'            => $barang['id'],
            'quantity'      => $quantity
        ]);


        return redirect()->to('User/pemasukan');
    }

    public function pengeluaranBarang()
    {
        $data = [
            'title'         => 'Pengeluaran Barang',
            'breadcrumb'    => ['Pengeluaran','Barang'],
            'barang'        =>  $this->BarangModel->findAll(),
            'user'          => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('User/Pengeluaran/barang', $data);
    }
    public function pengeluaranJasa()
    {
        $data = [
            'title' => 'Pengeluaran Jasa',
            'breadcrumb'    => ['Pengeluaran','Jasa'],
            'user'  => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('User/Pengeluaran/jasa', $data);
    }
    public function pengeluaranStockBarang()
    {
        $data = [
            'title' => 'Pengeluaran Jasa',
            'breadcrumb'    => ['Pengeluaran','Stock Barang'],
            'user'  => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('User/Pengeluaran/jasa', $data);
    }


}
