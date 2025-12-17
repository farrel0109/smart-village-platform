<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use App\Models\LetterType;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Get user's letter requests.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $letters = LetterRequest::with('letterType')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $letters->map(function ($letter) {
                return [
                    'id' => $letter->id,
                    'request_number' => $letter->request_number,
                    'letter_type' => $letter->letterType?->name,
                    'purpose' => $letter->purpose,
                    'status' => $letter->status,
                    'status_label' => $letter->status_label,
                    'created_at' => $letter->created_at->toISOString(),
                    'processed_at' => $letter->processed_at?->toISOString(),
                ];
            }),
            'meta' => [
                'current_page' => $letters->currentPage(),
                'last_page' => $letters->lastPage(),
                'per_page' => $letters->perPage(),
                'total' => $letters->total(),
            ],
        ]);
    }

    /**
     * Get available letter types.
     */
    public function types()
    {
        $types = LetterType::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'description']);

        return response()->json([
            'success' => true,
            'data' => $types,
        ]);
    }

    /**
     * Create a new letter request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_type_id' => ['required', 'exists:letter_types,id'],
            'purpose' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = $request->user();

        $letter = LetterRequest::create([
            'request_number' => LetterRequest::generateRequestNumber(),
            'user_id' => $user->id,
            'village_id' => $user->village_id,
            'letter_type_id' => $validated['letter_type_id'],
            'purpose' => $validated['purpose'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan surat berhasil dibuat',
            'data' => [
                'id' => $letter->id,
                'request_number' => $letter->request_number,
            ],
        ], 201);
    }

    /**
     * Get letter request detail.
     */
    public function show(Request $request, LetterRequest $letter)
    {
        if ($letter->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan',
            ], 403);
        }

        $letter->load('letterType');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $letter->id,
                'request_number' => $letter->request_number,
                'letter_type' => $letter->letterType?->name,
                'purpose' => $letter->purpose,
                'notes' => $letter->notes,
                'status' => $letter->status,
                'status_label' => $letter->status_label,
                'rejection_reason' => $letter->rejection_reason,
                'created_at' => $letter->created_at->toISOString(),
                'processed_at' => $letter->processed_at?->toISOString(),
            ],
        ]);
    }
}
