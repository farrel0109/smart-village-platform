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
        $stats = [
            'villages' => Village::where('is_active', true)->count(),
            'features' => 5,
        ];

        $villages = Village::where('is_active', true)
            ->select('id', 'name', 'regency')
            ->orderBy('name')
            ->get();

        return view('pages.landing.index', compact('stats', 'villages'));
    }
}
