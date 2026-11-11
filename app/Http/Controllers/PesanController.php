<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        return view('pesan-client');
    }

    public function admin()
    {
        return view('pesan-admin');
    }

    
}
