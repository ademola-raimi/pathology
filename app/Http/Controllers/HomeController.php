<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
     * Load home page
     *
     * @return home
     */
    public function index()
    {
    	return view('layout.home');
    }
}
