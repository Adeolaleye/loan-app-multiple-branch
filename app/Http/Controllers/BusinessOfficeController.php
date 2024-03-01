<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessOfficeController extends Controller
{
    public function index()
    {
        // Logic for the index page
        return view('home.index');
    }
}
