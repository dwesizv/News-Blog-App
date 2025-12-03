<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller {
    
    function __construct() {
        $this->middleware('auth');
    }

    function edit(): View {
        return view('auth.edit');
    }

    function index(): View {
        return view('auth.home');
    }

    function update(): RedirectResponse {

    }
}