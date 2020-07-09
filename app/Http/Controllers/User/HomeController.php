<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class HomeController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        return view('pages.user.dashboard', compact('apartments'));
    }
}
