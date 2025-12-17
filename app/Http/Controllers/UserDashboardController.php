<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\LetterRequest;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // Get user's letter requests
        $letters = LetterRequest::with('letterType')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $letterStats = [
            'total' => LetterRequest::where('user_id', $user->id)->count(),
            'pending' => LetterRequest::where('user_id', $user->id)->where('status', 'pending')->count(),
            'processing' => LetterRequest::where('user_id', $user->id)->where('status', 'processing')->count(),
            'completed' => LetterRequest::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];

        // Get latest announcements
        $announcements = Announcement::published()
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('pages.user.dashboard', compact('user', 'letters', 'letterStats', 'announcements'));
    }

    /**
     * Show all user's letters.
     */
    public function letters()
    {
        $letters = LetterRequest::with('letterType')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('pages.user.letters', compact('letters'));
    }

    /**
     * Show public announcements list.
     */
    public function announcements()
    {
        $announcements = Announcement::published()
            ->latest('published_at')
            ->paginate(12);

        return view('pages.user.announcements', compact('announcements'));
    }

    /**
     * Show single announcement.
     */
    public function showAnnouncement(Announcement $announcement)
    {
        if (!$announcement->is_published) {
            abort(404);
        }

        return view('pages.user.announcement-show', compact('announcement'));
    }
}
