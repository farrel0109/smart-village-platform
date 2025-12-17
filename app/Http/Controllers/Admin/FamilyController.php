<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Resident;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of families.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Family::with(['village', 'members']);

        // Admin desa hanya bisa lihat keluarga desa mereka
        if (!$user->isSuperAdmin() && $user->village_id) {
            $query->where('village_id', $user->village_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kk_number', 'like', "%{$search}%")
                  ->orWhere('head_name', 'like', "%{$search}%");
            });
        }

        $families = $query->withCount('members')->latest()->paginate(15);

        return view('pages.admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new family.
     */
    public function create()
    {
        $user = auth()->user();
        
        // Get available residents (not yet assigned to any family as head)
        $residentsQuery = Resident::whereNull('family_id');
        
        if (!$user->isSuperAdmin() && $user->village_id) {
            $residentsQuery->where('village_id', $user->village_id);
        }
        
        $residents = $residentsQuery->orderBy('name')->get();

        return view('pages.admin.families.create', compact('residents'));
    }

    /**
     * Store a newly created family.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'kk_number' => ['required', 'string', 'size:16', 'unique:families,kk_number'],
            'head_name' => ['required', 'string', 'max:100'],
            'head_resident_id' => ['nullable', 'exists:residents,id'],
            'address' => ['required', 'string'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
        ]);

        $validated['village_id'] = $user->isSuperAdmin() 
            ? ($request->village_id ?? $user->village_id) 
            : $user->village_id;
        $validated['status'] = 'active';

        $family = Family::create($validated);

        // Update head resident
        if ($validated['head_resident_id']) {
            Resident::where('id', $validated['head_resident_id'])->update([
                'family_id' => $family->id,
                'family_role' => 'head',
            ]);
        }

        return redirect()->route('admin.families.index')
            ->with('success', 'Kartu Keluarga berhasil ditambahkan.');
    }

    /**
     * Display the specified family.
     */
    public function show(Family $family)
    {
        $this->authorizeAction($family);

        $family->load(['village', 'members', 'headResident']);

        return view('pages.admin.families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified family.
     */
    public function edit(Family $family)
    {
        $this->authorizeAction($family);

        $user = auth()->user();
        
        // Get residents that can be added as head
        $residentsQuery = Resident::where(function($q) use ($family) {
            $q->whereNull('family_id')->orWhere('family_id', $family->id);
        });
        
        if (!$user->isSuperAdmin() && $user->village_id) {
            $residentsQuery->where('village_id', $user->village_id);
        }
        
        $residents = $residentsQuery->orderBy('name')->get();

        return view('pages.admin.families.edit', compact('family', 'residents'));
    }

    /**
     * Update the specified family.
     */
    public function update(Request $request, Family $family)
    {
        $this->authorizeAction($family);

        $validated = $request->validate([
            'kk_number' => ['required', 'string', 'size:16', 'unique:families,kk_number,' . $family->id],
            'head_name' => ['required', 'string', 'max:100'],
            'head_resident_id' => ['nullable', 'exists:residents,id'],
            'address' => ['required', 'string'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        // If head resident changed, update old and new
        if ($family->head_resident_id !== $validated['head_resident_id']) {
            // Remove old head
            if ($family->head_resident_id) {
                Resident::where('id', $family->head_resident_id)->update([
                    'family_role' => null,
                ]);
            }
            // Set new head
            if ($validated['head_resident_id']) {
                Resident::where('id', $validated['head_resident_id'])->update([
                    'family_id' => $family->id,
                    'family_role' => 'head',
                ]);
            }
        }

        $family->update($validated);

        return redirect()->route('admin.families.index')
            ->with('success', 'Kartu Keluarga berhasil diperbarui.');
    }

    /**
     * Remove the specified family.
     */
    public function destroy(Family $family)
    {
        $this->authorizeAction($family);

        // Remove family association from members
        Resident::where('family_id', $family->id)->update([
            'family_id' => null,
            'family_role' => null,
        ]);

        $family->delete();

        return redirect()->route('admin.families.index')
            ->with('success', 'Kartu Keluarga berhasil dihapus.');
    }

    /**
     * Add a member to the family.
     */
    public function addMember(Request $request, Family $family)
    {
        $this->authorizeAction($family);

        $validated = $request->validate([
            'resident_id' => ['required', 'exists:residents,id'],
            'family_role' => ['required', 'in:wife,child,parent,other'],
        ]);

        Resident::where('id', $validated['resident_id'])->update([
            'family_id' => $family->id,
            'family_role' => $validated['family_role'],
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Remove a member from the family.
     */
    public function removeMember(Family $family, Resident $resident)
    {
        $this->authorizeAction($family);

        if ($resident->family_id !== $family->id) {
            return back()->with('error', 'Penduduk bukan anggota keluarga ini.');
        }

        $resident->update([
            'family_id' => null,
            'family_role' => null,
        ]);

        return back()->with('success', 'Anggota berhasil dihapus dari keluarga.');
    }

    /**
     * Check if current user can manage this family.
     */
    private function authorizeAction(Family $family)
    {
        $currentUser = auth()->user();

        if ($currentUser->isSuperAdmin()) {
            return true;
        }

        if ($currentUser->village_id !== $family->village_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengelola keluarga ini.');
        }

        return true;
    }
}
