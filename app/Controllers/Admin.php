<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use \App\Models\UserModel;
use \App\Models\BarangModel;
use \App\Models\PengeluaranModel;
use \App\Models\PemasukanModel;

class Admin extends BaseController
{
    protected $UserModel;
    protected $BarangModel;
    protected $PengeluaranModel;
    protected $PemasukanModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->BarangModel = new BarangModel();
        $this->PengeluaranModel = new PengeluaranModel();
        $this->PemasukanModel = new PemasukanModel();
        $this->blockOut();
    }
    public function dashboard()
    {
        $date = date('Y-m-d');
        $int = strtotime($date) - (3600*24*5);
        $time = [];
        $arrayPnegeluaran = [];
        for ($i=0; $i < 5; $i++) { 
            $int = $int + 3600*24;
            array_push($time,date('d-M-Y',$int));
        }
        $data = [
            'title'                 => 'Dashboard',
            'namaBarang'            => $this->BarangModel->namaBarang(),
            'quantity'              => $this->BarangModel->quantity(),
            'pengeluaranBulanan'    => $this->PengeluaranModel->pengeluaranBulanan(),
            'pemasukanBulanan'      => $this->PemasukanModel->pemasukanBulanan(),
            'pemasukanHarian'       => $this->PemasukanModel->pemasukanHarian(),
            'pengeluaranHarian'     => $this->PengeluaranModel->pengeluaranHarian(),
            'date'                  => $time,
            'user'                  => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];

        return view('Admin/dashboard', $data);
    }
    public function penggajian()
    {
        $data = [
            'title' => 'Penggajian',
            'user'  => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('Admin/penggajian', $data);
    }
    public function stockBarang()
    {
        $barang = $this->BarangModel->findAll();
        $data = [
            'title'     => 'Stock Barang',
            'barang'    => $barang,
            'user'      => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('Admin/stockBarang', $data);
    }

    public function tambahBarang()
    {
        $data = [
            'title' => 'Tambah Barang',
            'user'  => $this->UserModel->where(['username' => session()->get('username')])->first(),
        ];
        return view('Admin/StockBarang/tambahBarang', $data);
    }

    public function tambahBarang_()
    {
        $jenisBarang = $this->request->getVar('jenisBarang');
        $namaBarang = $this->request->getVar('namaBarang');
        $hargaBeli = $this->request->getVar('hargaBeli');
        $hargaJual = $this->request->getVar('hargaJual');
        $getImage = $this->request->getFile('image');

        $upload = $getImage->getName();
        // beri penamaan
        $upload = date('d-m-Y') . '_' . $upload;
        // move image
        $getImage->move('img/stockBarang',$upload);
    
        $this->BarangModel->save([
            'jenisBarang'       => $jenisBarang,
            'namaBarang'        => $namaBarang,
            'quantity'          => 0,
            'hargaBeli'         => $hargaBeli,
            'hargaJual'         => $hargaJual,
            'image'             => $upload
        ]);

        return redirect()->to('Admin/stockBarang');
    }

    public function editHarga_($id)
    {
        $hargaBeli = $this->request->getVar('hargaBeli');
        $hargaJual = $this->request->getVar('hargaJual');
        $this->BarangModel->save([
            'id'            =>  $id,
            'hargaBeli'     =>  $hargaBeli,
            'hargaJual'     =>  $hargaJual
        ]);
        
        return redirect()->to('Admin/stockBarang');
    }

    public function deleteBarang_($id)
    {
        $this->BarangModel->delete([
            '$id'   =>$id
        ]);
        return redirect()->to('Admin/stockBarang');
    }

    public function blockOut()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        if (session('username') == null) {
            session()->setFlashdata('danger', 'Harap Login terlebih dahulu');
            header('Location: ' . base_url(''));
            exit();
        } else {
            $role_id = session()->get('role_id');
            // $segments = $this->request->getSegments();

            $menu = $request->uri->getSegment(1);
            if ($menu == 'Admin') {
                $menu = "Administrator";
            } elseif ($menu == 'User') {
                $menu = "User";
            }
            $query = $db->table('user_menu')->getWhere(['menu' => $menu])
                ->getResultArray();
            foreach ($query as $key => $menu_id) {
            }
            $a = intval($role_id);
            $b = intval($menu_id['id']);
            if ($a > $b) {
                session()->setFlashdata('danger', 'Anda tidak memiliki hak akses ke url tersebut');
                header('Location: ' . base_url('User/pemasukan'));
                exit();
            }
        }
    }




}
