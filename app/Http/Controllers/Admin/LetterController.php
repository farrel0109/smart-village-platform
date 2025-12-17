<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of letter requests.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $status = $request->get('status', 'pending');

        $query = LetterRequest::with(['user', 'letterType', 'processor']);

        // Admin desa hanya bisa lihat request desa mereka
        if (!$user->isSuperAdmin() && $user->village_id) {
            $query->where('village_id', $user->village_id);
        }

        // Filter by status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $requests = $query->orderBy('created_at', 'desc')->paginate(15);

        // Count by status
        $countQuery = LetterRequest::query();
        if (!$user->isSuperAdmin() && $user->village_id) {
            $countQuery->where('village_id', $user->village_id);
        }

        $counts = [
            'pending' => (clone $countQuery)->where('status', 'pending')->count(),
            'processing' => (clone $countQuery)->where('status', 'processing')->count(),
            'completed' => (clone $countQuery)->where('status', 'completed')->count(),
            'rejected' => (clone $countQuery)->where('status', 'rejected')->count(),
        ];

        return view('pages.admin.letters.index', compact('requests', 'status', 'counts'));
    }

    /**
     * Show a letter request detail.
     */
    public function show(LetterRequest $letter)
    {
        $this->authorizeAction($letter);

        $letter->load(['user', 'letterType', 'processor', 'village']);

        return view('pages.admin.letters.show', compact('letter'));
    }

    /**
     * Process a letter request.
     */
    public function process(LetterRequest $letter)
    {
        $this->authorizeAction($letter);

        $letter->update([
            'status' => 'processing',
            'processed_by' => auth()->id(),
        ]);

        return back()->with('success', 'Pengajuan sedang diproses.');
    }

    /**
     * Complete a letter request.
     */
    public function complete(Request $request, LetterRequest $letter)
    {
        $this->authorizeAction($letter);

        $letter->update([
            'status' => 'completed',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Pengajuan telah selesai.');
    }

    /**
     * Reject a letter request.
     */
    public function reject(Request $request, LetterRequest $letter)
    {
        $this->authorizeAction($letter);

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $letter->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Pengajuan telah ditolak.');
    }

    /**
     * Download letter as PDF.
     */
    public function download(LetterRequest $letter)
    {
        $this->authorizeAction($letter);

        // Only allow download if completed
        if ($letter->status !== 'completed') {
            return back()->with('error', 'Surat hanya dapat diunduh setelah selesai diproses.');
        }

        $letter->load(['user', 'letterType', 'village', 'processor']);

        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.letters.generic', [
            'letter' => $letter,
            'title' => $letter->letterType->name ?? 'Surat Keterangan',
        ]);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Generate filename
        $filename = 'Surat_' . str_replace('/', '-', $letter->request_number) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Check if current user can manage this request.
     */
    private function authorizeAction(LetterRequest $letter)
    {
        $currentUser = auth()->user();

        if ($currentUser->isSuperAdmin()) {
            return true;
        }

        if ($currentUser->village_id !== $letter->village_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengelola pengajuan ini.');
        }

        return true;
    }
}
