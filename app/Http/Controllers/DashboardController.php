<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\LetterRequest;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics.
     */
    public function index()
    {
        // Resident statistics
        $stats = [
            'total_penduduk' => Resident::count(),
            'total_aktif' => Resident::where('status', 'active')->count(),
            'total_pindah' => Resident::where('status', 'moved')->count(),
            'total_meninggal' => Resident::where('status', 'deceased')->count(),
            'laki_laki' => Resident::where('gender', 'male')->count(),
            'perempuan' => Resident::where('gender', 'female')->count(),
        ];

        // Letter request statistics
        $letterStats = [
            'total' => LetterRequest::count(),
            'pending' => LetterRequest::where('status', 'pending')->count(),
            'processing' => LetterRequest::where('status', 'processing')->count(),
            'completed' => LetterRequest::where('status', 'completed')->count(),
            'rejected' => LetterRequest::where('status', 'rejected')->count(),
            'this_month' => LetterRequest::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
        ];

        // User statistics
        $userStats = [
            'total' => User::count(),
            'pending' => User::where('status', 'pending')->count(),
            'approved' => User::where('status', 'approved')->count(),
            'rejected' => User::where('status', 'rejected')->count(),
        ];

        // Age distribution for chart
        $ageDistribution = $this->getAgeDistribution();

        // Recent letters (last 5)
        $recentLetters = LetterRequest::with(['user', 'letterType'])
            ->latest()
            ->take(5)
            ->get();

        // Recent users (last 5)
        $recentUsers = User::with('role')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard', compact(
            'stats',
            'letterStats',
            'userStats',
            'ageDistribution',
            'recentLetters',
            'recentUsers'
        ));
    }

    /**
     * Calculate age distribution for residents.
     */
    private function getAgeDistribution(): array
    {
        $residents = Resident::whereNotNull('birth_date')->get();
        
        $distribution = [
            '0-17' => 0,
            '18-30' => 0,
            '31-45' => 0,
            '46-60' => 0,
            '60+' => 0,
        ];

        foreach ($residents as $resident) {
            $age = Carbon::parse($resident->birth_date)->age;
            
            if ($age <= 17) {
                $distribution['0-17']++;
            } elseif ($age <= 30) {
                $distribution['18-30']++;
            } elseif ($age <= 45) {
                $distribution['31-45']++;
            } elseif ($age <= 60) {
                $distribution['46-60']++;
            } else {
                $distribution['60+']++;
            }
        }

        return $distribution;
    }
}
