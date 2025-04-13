<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class RememberMe extends BaseController
{
    public function setUserCookie($user)
    {
        $cookieNama = hash('sha256', base64_encode($user['nama']));
        $cookieEmail = base64_encode($user['email']);

        set_cookie('_app*Us^rNm', $cookieNama, '3 days');
        set_cookie('_mai-L*appUsr', $cookieEmail, '3 days');
    }

    public function checkUserCookie()
    {
        $cookieNama = get_cookie('_app*Us^rNm');
        $cookieEmail = get_cookie('_mai-L*appUsr');

        if($cookieNama && $cookieEmail) {
            $userModel = new User();

            $user = $userModel
                ->select('nama, email')
                ->where('email', base64_decode($cookieEmail))
                ->where('is_active', 1)
                ->first();

            $hashedNama = hash('sha256', base64_encode($user['nama']));
            $decodedCookieEmail = base64_decode($cookieEmail);

            if($hashedNama === $cookieNama && $user['email'] === $decodedCookieEmail) {
                $session = \Config\Services::session();

                $session->set('user', [
                    'isLoggedIn' => TRUE,
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ]);

                return true;
            }
        }
    }
}
