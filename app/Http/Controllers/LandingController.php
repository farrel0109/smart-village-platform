<?php

namespace App\Http\Controllers;

use App\Models\Village;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        return view('welcome');
    }
}
