<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;


class MainController extends BaseController
{
    //
    public function index()
    {
        return view('welcome');
    }
}
