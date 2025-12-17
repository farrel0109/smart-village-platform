<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Show settings form.
     */
    public function index()
    {
        $settings = [
            'village_name' => Setting::get('village_name', ''),
            'village_address' => Setting::get('village_address', ''),
            'village_phone' => Setting::get('village_phone', ''),
            'village_email' => Setting::get('village_email', ''),
            'village_head_name' => Setting::get('village_head_name', ''),
            'village_logo' => Setting::get('village_logo', ''),
            'app_name' => Setting::get('app_name', 'Desa Pintar'),
            'app_description' => Setting::get('app_description', ''),
        ];

        return view('pages.admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'village_name' => ['nullable', 'string', 'max:255'],
            'village_address' => ['nullable', 'string', 'max:500'],
            'village_phone' => ['nullable', 'string', 'max:20'],
            'village_email' => ['nullable', 'email', 'max:255'],
            'village_head_name' => ['nullable', 'string', 'max:255'],
            'app_name' => ['nullable', 'string', 'max:255'],
            'app_description' => ['nullable', 'string', 'max:500'],
            'village_logo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle logo upload
        if ($request->hasFile('village_logo')) {
            // Delete old logo
            $oldLogo = Setting::get('village_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Store new logo
            $path = $request->file('village_logo')->store('settings', 'public');
            Setting::set('village_logo', $path, 'village', 'file');
        }

        // Save text settings
        $textSettings = [
            'village_name',
            'village_address', 
            'village_phone',
            'village_email',
            'village_head_name',
            'app_name',
            'app_description',
        ];

        foreach ($textSettings as $key) {
            if (isset($validated[$key])) {
                Setting::set($key, $validated[$key], 'village', 'text');
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    /**
     * Remove logo.
     */
    public function removeLogo()
    {
        $logo = Setting::get('village_logo');
        if ($logo && Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }
        
        Setting::set('village_logo', null, 'village', 'file');

        return back()->with('success', 'Logo berhasil dihapus.');
    }
}
