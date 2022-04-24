<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;

class Home extends BaseController
{
    public function index()
    {
        //return view('welcome_message');
        $request = service('request');
        $authHeader = $request->getHeader('Authorization');
        return (time());
    }
}
