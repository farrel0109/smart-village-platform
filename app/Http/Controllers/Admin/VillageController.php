<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Village;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VillageController extends Controller
{
    /**
     * Display a listing of villages.
     */
    public function index()
    {
        $villages = Village::withCount(['users', 'residents'])
            ->orderBy('regency')
            ->orderBy('name')
            ->paginate(15);

        return view('pages.admin.villages.index', compact('villages'));
    }

    /**
     * Show the form for creating a new village.
     */
    public function create()
    {
        return view('pages.admin.villages.create');
    }

    /**
     * Store a newly created village.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:20', 'unique:villages'],
            'province' => ['required', 'string', 'max:100'],
            'regency' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'email' => ['nullable', 'email', 'max:100'],
            // Admin user fields
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'email', 'unique:users,email'],
            'admin_password' => ['required', 'string', 'min:6'],
        ]);

        // Create village
        $village = Village::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'province' => $validated['province'],
            'regency' => $validated['regency'],
            'district' => $validated['district'],
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'is_active' => true,
        ]);

        // Create admin user for this village
        $adminRoleId = Role::where('name', 'admin')->value('id');
        
        User::create([
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'password' => Hash::make($validated['admin_password']),
            'role_id' => $adminRoleId,
            'village_id' => $village->id,
            'status' => 'approved',
        ]);

        return redirect()->route('admin.villages.index')
            ->with('success', "Desa {$village->name} berhasil didaftarkan beserta admin.");
    }

    /**
     * Show the form for editing a village.
     */
    public function edit(Village $village)
    {
        return view('pages.admin.villages.edit', compact('village'));
    }

    /**
     * Update the specified village.
     */
    public function update(Request $request, Village $village)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:20', Rule::unique('villages')->ignore($village->id)],
            'province' => ['required', 'string', 'max:100'],
            'regency' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'email' => ['nullable', 'email', 'max:100'],
            'is_active' => ['boolean'],
        ]);

        $village->update($validated);

        return redirect()->route('admin.villages.index')
            ->with('success', "Desa {$village->name} berhasil diperbarui.");
    }

    /**
     * Remove the specified village.
     */
    public function destroy(Village $village)
    {
        $villageName = $village->name;
        
        // Check if village has users or residents
        if ($village->users()->count() > 0 || $village->residents()->count() > 0) {
            return back()->with('error', 'Desa tidak dapat dihapus karena masih memiliki user atau penduduk terdaftar.');
        }

        $village->delete();

        return redirect()->route('admin.villages.index')
            ->with('success', "Desa {$villageName} berhasil dihapus.");
    }
}
