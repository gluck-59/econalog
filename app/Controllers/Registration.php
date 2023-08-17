<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Registration extends BaseController
{
    public function index()
    {
        return view('auth/register', [
            'title' => 'Registration Page',
            // 'validation' => $this->validation
        ]);
    }
}
