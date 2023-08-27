<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class ChangePassword extends BaseController
{
    public function index()
    {
        if($this->session->get('user')) {
            return redirect()->back();
        }

        if(!$this->session->get('email')) {
            return redirect()->to('/login');
        }

        return view('auth/change-password', [
            'title' => 'Change Password',
            'session' => $this->session,
        ]);
    }

    public function updateForgotPassword()
    {
        $rules = [
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
                'password' => $this->validation->getError('password'),
                'passwordConfirmation' => $this->validation->getError('passwordConfirmation'),
            ];

            return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
        } else {
            $password = $this->request->getPost('password');
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            $email = $this->session->get('email');

            $userModel = new User();
            $userModel->updatePassword($email, $encryptedPassword);

            $this->session->remove('email');

            $this->session->setFlashdata('success', 'Password has been changed');
            return $this->response->setJSON(['status' => TRUE, 'redirectUrl' => '/login']);
        }
    }
}
