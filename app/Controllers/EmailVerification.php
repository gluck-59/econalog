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
        $verificationLink = base_url("email-verification/{$verificationToken}");
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

    public function verifyEmail($token)
    {
        $userToken = $this->UserTokenModel->findValidToken($token);

        if($userToken) {
            // set user active
            $this->UserModel->markAsActive($userToken['user_id']);

            // delete all token based on user_id
            $this->UserTokenModel->where('user_id', $userToken['user_id'])->delete();

            echo json_encode(['status' => TRUE, 'message' => 'Email has been verified']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Invalid Token']);
        }
    }
}
