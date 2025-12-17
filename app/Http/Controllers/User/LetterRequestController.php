<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use App\Models\LetterType;
use Illuminate\Http\Request;

class LetterRequestController extends Controller
{
    /**
     * Display user's letter requests.
     */
    public function index()
    {
        $requests = LetterRequest::with(['letterType'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.user.letters.index', compact('requests'));
    }

    /**
     * Show form to create a new letter request.
     */
    public function create()
    {
        $letterTypes = LetterType::where('is_active', true)->get();

        return view('pages.user.letters.create', compact('letterTypes'));
    }

    /**
     * Store a new letter request.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->village_id) {
            return back()->with('error', 'Anda belum terdaftar di desa manapun.');
        }

        $validated = $request->validate([
            'letter_type_id' => ['required', 'exists:letter_types,id'],
            'purpose' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        LetterRequest::create([
            'request_number' => LetterRequest::generateRequestNumber(),
            'user_id' => $user->id,
            'village_id' => $user->village_id,
            'letter_type_id' => $validated['letter_type_id'],
            'purpose' => $validated['purpose'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('user.letters.index')
            ->with('success', 'Pengajuan surat berhasil dikirim. Silakan tunggu proses verifikasi dari admin desa.');
    }

    /**
     * Show letter request detail.
     */
    public function show(LetterRequest $letter)
    {
        // Ensure user can only view their own requests
        if ($letter->user_id !== auth()->id()) {
            abort(403);
        }

        $letter->load(['letterType', 'processor']);

        return view('pages.user.letters.show', compact('letter'));
    }
}
