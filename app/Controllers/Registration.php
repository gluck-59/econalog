<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Registration extends BaseController
{
    public function index()
    {
        return view('auth/register', [
            'title' => 'Registration Page',
        ]);
    }
    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email[users.email]',
            'password' => 'required|min_length[8]',
            'passwordConfirmation' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password Confirmation is required',
                    'matches' => 'Password Confirmation does not match'
                ]
            ]
        ];

        if(!$this->validate($rules)) {
            $errors = [
                'nama' => $this->validation->getError('nama'),
                'email' => $this->validation->getError('email'),
                'password' => $this->validation->getError('password'),
                'passwordConfirmation' => $this->validation->getError('passwordConfirmation')
            ];

            echo json_encode(['status' => FALSE, 'errors' => $errors]);
        } else {
            $model = new User();

            $password = $this->request->getPost('password');
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'password' => $encryptedPassword,
                'user_level' => 1,
                'is_active' => 0,
            ];

            $model->insert($data);

            echo json_encode(['status' => TRUE, 'message' => 'Registration Success']);
        }
    }
}
