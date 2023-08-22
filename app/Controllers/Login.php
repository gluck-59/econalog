<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login Page',
            'session' => $this->session,
        ];

        return view('auth/login', $data);
    }
}
