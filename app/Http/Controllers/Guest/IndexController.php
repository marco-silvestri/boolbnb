<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class IndexController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        return view('pages.index', compact('apartments'));
    }
}
