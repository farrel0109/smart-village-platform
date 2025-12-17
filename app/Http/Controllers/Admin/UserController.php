<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $status = $request->get('status', 'submitted');

        $query = User::with(['role', 'village'])
            ->whereHas('role', fn($q) => $q->where('name', 'user'));

        // Admin desa hanya bisa lihat user desa mereka
        if (!$user->isSuperAdmin() && $user->village_id) {
            $query->where('village_id', $user->village_id);
        }

        // Filter by status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        // Count by status for tabs
        $countQuery = User::whereHas('role', fn($q) => $q->where('name', 'user'));
        if (!$user->isSuperAdmin() && $user->village_id) {
            $countQuery->where('village_id', $user->village_id);
        }

        $counts = [
            'submitted' => (clone $countQuery)->where('status', 'submitted')->count(),
            'approved' => (clone $countQuery)->where('status', 'approved')->count(),
            'rejected' => (clone $countQuery)->where('status', 'rejected')->count(),
        ];

        return view('pages.admin.users.index', compact('users', 'status', 'counts'));
    }

    /**
     * Approve a user.
     */
    public function approve(User $user)
    {
        $this->authorizeAction($user);

        $user->update(['status' => 'approved']);

        return back()->with('success', "User {$user->name} berhasil disetujui.");
    }

    /**
     * Reject a user.
     */
    public function reject(User $user)
    {
        $this->authorizeAction($user);

        $user->update(['status' => 'rejected']);

        return back()->with('success', "User {$user->name} telah ditolak.");
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $this->authorizeAction($user);

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User {$userName} berhasil dihapus.");
    }

    /**
     * Check if current user can manage this user.
     */
    private function authorizeAction(User $targetUser)
    {
        $currentUser = auth()->user();

        // Superadmin can manage all
        if ($currentUser->isSuperAdmin()) {
            return true;
        }

        // Admin can only manage users in their village
        if ($currentUser->village_id !== $targetUser->village_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengelola user ini.');
        }

        return true;
    }
}
