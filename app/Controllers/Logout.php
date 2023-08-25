<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        if(get_cookie('_app*Us^rNm') && get_cookie('_mai-L*appUsr')) {
            delete_cookie('_app*Us^rNm');
            delete_cookie('_mai-L*appUsr');
        }

        $this->session->destroy();

        return redirect()->to('/login')->withCookies();
    }
}
