<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentRequest;
use App\Models\Resident;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource with pagination.
     */
    public function index()
    {
        $residents = Resident::orderBy('created_at', 'desc')->paginate(15);
        return view('pages.resident.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.resident.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidentRequest $request)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('residents', 'public');
        }

        Resident::create($data);

        return redirect()->route('residents.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resident $resident)
    {
        return view('pages.resident.edit', compact('resident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResidentRequest $request, Resident $resident)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
                Storage::disk('public')->delete($resident->photo);
            }
            $data['photo'] = $request->file('photo')->store('residents', 'public');
        }

        $resident->update($data);

        return redirect()->route('residents.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
        // Delete photo
        if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
            Storage::disk('public')->delete($resident->photo);
        }

        $resident->delete();

        return redirect()->route('residents.index')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }

    /**
     * Remove resident photo.
     */
    public function removePhoto(Resident $resident)
    {
        if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
            Storage::disk('public')->delete($resident->photo);
        }
        
        $resident->update(['photo' => null]);

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
