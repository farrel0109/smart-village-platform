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
            'dynamic_data' => ['nullable', 'array'],
            'attachments' => ['required', 'array'],
            'attachments.rt' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'attachments.rw' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'attachments.other.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        // Handle File Uploads
        $attachments = [];
        
        // RT
        if ($request->hasFile('attachments.rt')) {
            $path = $request->file('attachments.rt')->store('letters/attachments', 'public');
            $attachments['rt'] = $path;
        }

        // RW
        if ($request->hasFile('attachments.rw')) {
            $path = $request->file('attachments.rw')->store('letters/attachments', 'public');
            $attachments['rw'] = $path;
        }

        // Other
        if ($request->hasFile('attachments.other')) {
            $attachments['other'] = [];
            foreach ($request->file('attachments.other') as $file) {
                $path = $file->store('letters/attachments', 'public');
                $attachments['other'][] = $path;
            }
        }

        LetterRequest::create([
            'request_number' => LetterRequest::generateRequestNumber(),
            'user_id' => $user->id,
            'village_id' => $user->village_id,
            'letter_type_id' => $validated['letter_type_id'],
            'purpose' => $validated['purpose'],
            'notes' => $validated['notes'] ?? null,
            'dynamic_data' => $validated['dynamic_data'] ?? null,
            'attachments' => $attachments,
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
