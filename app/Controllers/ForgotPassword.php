<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\EmailVerification;
use App\Models\User;

class ForgotPassword extends BaseController
{
    public function index()
    {
        if($this->session->get('user')) {
            return redirect()->back();
        }

        return view('auth/forgot-password', [
            'title' => 'Forgot Password',
            'session' => $this->session,
        ]);
    }

    public function resetPassword()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if(!$this->validate($rules)) {
            $errors = [
                'email' => $this->validation->getError('email'),
            ];

            return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
        } else {
            $email = $this->request->getPost('email');

            $userModel = new User();
            $user = $userModel
                ->select('user_id, email, is_active')
                ->where('email', $email)
                ->where('is_active', 1)
                ->first();

            if(!$user) {
                $errors = [
                    'email' => 'Email is not registered',
                ];

                return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
            } else {
                $emailVerification = new EmailVerification();
                $emailVerification->sendEmail($user['user_id'], $email, 'forgot-password');

                $this->session->setFlashdata('success', 'Reset password link has been sent to your email.');
                return $this->response->setJSON(['status' => TRUE, 'redirectUrl' => '/forgot-password']);
            }
        }
    }
}
