<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // после авторизации
        $data = ['jopa' => 'odna'];

        return view('header', $data)
        .view('admin', [
            'title' => 'Admin Home Page',
            'session' => $this->session,
        ])
        .view('footer',$data);

    }


    public function jopa() {
        die('jopa');
    }
}
