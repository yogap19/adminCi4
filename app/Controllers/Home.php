<?php

namespace App\Controllers;

use \App\Models\UserModel;

class Home extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Admin Stock',
        ];
        return view('Auth/login', $data);
    }

    public function login_()
    {
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");
        $user = $this->UserModel->where(['username' => $username])->first();
        $data = [
            'title' => '',
            'user'  => $user
        ];
        if ($user) {
            if ($password == $user['password']) {
                if ($user['role_id']==1) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    session()->set($data);
                    return redirect()->to('Admin/dashboard');
                } else{
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    session()->set($data);
                    return redirect()->to('User/pemasukan');
                }
            }
        }
        return redirect()->to('');
    }

    public function logout_()
	{
		unset(
			$_SESSION['username'],
			$_SESSION['role_id']
		);
		session()->setFlashdata('logout', 'You have successfully Logout');
		return redirect()->to('');
	}
}
