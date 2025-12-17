<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Get published announcements.
     */
    public function index(Request $request)
    {
        $announcements = Announcement::published()
            ->latest('published_at')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $announcements->map(function ($announcement) {
                return [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'slug' => $announcement->slug,
                    'excerpt' => $announcement->excerpt,
                    'category' => $announcement->category,
                    'category_label' => $announcement->category_label,
                    'image_url' => $announcement->image ? asset('storage/' . $announcement->image) : null,
                    'published_at' => $announcement->published_at->toISOString(),
                ];
            }),
            'meta' => [
                'current_page' => $announcements->currentPage(),
                'last_page' => $announcements->lastPage(),
                'per_page' => $announcements->perPage(),
                'total' => $announcements->total(),
            ],
        ]);
    }

    /**
     * Get single announcement.
     */
    public function show(Announcement $announcement)
    {
        if (!$announcement->is_published) {
            return response()->json([
                'success' => false,
                'message' => 'Pengumuman tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $announcement->id,
                'title' => $announcement->title,
                'slug' => $announcement->slug,
                'content' => $announcement->content,
                'category' => $announcement->category,
                'category_label' => $announcement->category_label,
                'image_url' => $announcement->image ? asset('storage/' . $announcement->image) : null,
                'author' => $announcement->author?->name,
                'published_at' => $announcement->published_at->toISOString(),
            ],
        ]);
    }
}
