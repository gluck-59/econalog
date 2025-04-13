<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\RememberMe;
use App\Models\User;

class Login extends BaseController
{
    protected $rememberMe;

    public function __construct()
    {
        $this->rememberMe = new RememberMe();
    }

    public function index()
    {
        if($this->session->get('user')) {
            return redirect()->back();
        }

        // check user cookie
        if($this->rememberMe->checkUserCookie() === TRUE) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login Page',
            'session' => $this->session,
        ];

        return view('auth/login', $data);
    }

    public function authenticate()
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if(!$this->validate($rules)) {
            $errors = [
                'email' => $this->validation->getError('email'),
                'password' => $this->validation->getError('password'),
            ];

            return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new User();
            $user = $userModel->findUserActiveByEmail($email);

            if(!$user) {
                $errors = [
                    'email' => 'Email not found',
                ];
                return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
            }

            if(!password_verify($password, $user['password'])) {
                $errors = [
                    'password' => 'Wrong Password',
                ];
                return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
            }

            // Set user cookie if remember me checked
            if($this->request->getPost('rememberMe')) {
                $this->rememberMe->setUserCookie($user);
            }
            $this->session->set('user', [
                'isLoggedIn' => true,
                'user_id' => $user['user_id'],
                'nama' => $user['nama'],
                'fio' => $user['fio'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]);
            $this->session->setFlashdata('login-success', 'Login success, welcome back ' . $user['nama']);

            return $this->response->setJSON([
                'status' => TRUE,
                'redirectUrl' => '/',
            ]);
        }
    }
}
