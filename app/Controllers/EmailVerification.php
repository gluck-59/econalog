<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserToken;
use App\Models\User;

class EmailVerification extends BaseController
{
    protected $UserTokenModel;
    protected $UserModel;

    public function __construct()
    {
        $this->UserTokenModel = new UserToken();
        $this->UserModel = new User();
    }

    public function sendEmail($user_id, $userEmail)
    {
        $email = \Config\Services::email();

        $verificationToken = bin2hex(random_bytes(32));
        $verificationLink = base_url("email-verification?token={$verificationToken}");
        $tokenExpiration = date('Y-m-d H:i:s', strtotime('+30 Minutes'));

        $email->setTo($userEmail);

        $email->setSubject('Account Verification');
        $email->setMessage("Click this link to verify your account : <a href='$verificationLink'>Click Here</a>");

        $data = [
            'user_id' => $user_id,
            'token' => $verificationToken,
            'expire_at' => $tokenExpiration
        ];

        $this->UserTokenModel->insert($data);

        $email->send();
    }

    public function verifyEmail()
    {
        $token = $this->request->getVar('token');
        $userToken = $this->UserTokenModel->findValidToken($token);

        if($userToken) {
            // set user active
            $this->UserModel->markAsActive($userToken['user_id']);

            // delete all token based on user_id
            $this->UserTokenModel->where('user_id', $userToken['user_id'])->delete();

            $this->session->setFlashdata('registration-success', 'Your account has been verified.');
            return redirect()->to('/login');
        } else {
            $this->session->setFlashdata('registration-failed', 'Invalid token or token has been expired.');
            return redirect()->to('/registration');
        }
    }

    public function viewResendEmailVerification()
    {
        return view('auth/resend-email-verification', [
            'title' => 'Resend Email Verification',
            'session' => $this->session,
        ]);
    }

    public function resendEmailVerification()
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

            $user = $this->UserModel
                ->select('user_id, email, is_active')
                ->where('email', $email)->first();

            if(!$user || $user['is_active'] == 1) {
                $errors = [
                    'email' => 'Email is not registered or has been verified.',
                ];

                return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
            } else {
                $this->sendEmail($user['user_id'], $email);

                $this->session->setFlashdata('success', 'Email verification has been sent.');
                return $this->response->setJSON(['status' => TRUE, 'redirectUrl' => '/email-verification/resend']);
            }
        }
    }
}
