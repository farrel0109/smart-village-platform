<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LetterTemplate;
use App\Models\LetterType;
use Illuminate\Http\Request;

class LetterTemplateController extends Controller
{
    /**
     * Display a listing of templates.
     */
    public function index()
    {
        $templates = LetterTemplate::with('letterType')
            ->latest()
            ->paginate(15);

        return view('pages.admin.letter-templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     */
    public function create()
    {
        $letterTypes = LetterType::orderBy('name')->get();
        $placeholders = LetterTemplate::getAvailablePlaceholders();

        return view('pages.admin.letter-templates.create', compact('letterTypes', 'placeholders'));
    }

    /**
     * Store a newly created template.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_type_id' => ['required', 'exists:letter_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        LetterTemplate::create($validated);

        return redirect()->route('admin.letter-templates.index')
            ->with('success', 'Template surat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the template.
     */
    public function edit(LetterTemplate $letterTemplate)
    {
        $letterTypes = LetterType::orderBy('name')->get();
        $placeholders = LetterTemplate::getAvailablePlaceholders();

        return view('pages.admin.letter-templates.edit', compact('letterTemplate', 'letterTypes', 'placeholders'));
    }

    /**
     * Update the specified template.
     */
    public function update(Request $request, LetterTemplate $letterTemplate)
    {
        $validated = $request->validate([
            'letter_type_id' => ['required', 'exists:letter_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $letterTemplate->update($validated);

        return redirect()->route('admin.letter-templates.index')
            ->with('success', 'Template surat berhasil diperbarui.');
    }

    /**
     * Remove the specified template.
     */
    public function destroy(LetterTemplate $letterTemplate)
    {
        $letterTemplate->delete();

        return redirect()->route('admin.letter-templates.index')
            ->with('success', 'Template surat berhasil dihapus.');
    }

    /**
     * Preview template with sample data.
     */
    public function preview(LetterTemplate $letterTemplate)
    {
        $sampleData = [
            'nama' => 'John Doe',
            'nik' => '1234567890123456',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '01 Januari 1990',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'Wiraswasta',
            'alamat' => 'Jl. Contoh No. 123',
            'keperluan' => 'Pembuatan KTP',
            'nomor_surat' => 'SKT/2025/001',
            'tanggal_sekarang' => now()->format('d F Y'),
            'nama_desa' => 'Desa Contoh',
            'kepala_desa' => 'H. Ahmad',
        ];

        $parsedContent = $letterTemplate->parseContent($sampleData);

        return view('pages.admin.letter-templates.preview', compact('letterTemplate', 'parsedContent'));
    }
}
