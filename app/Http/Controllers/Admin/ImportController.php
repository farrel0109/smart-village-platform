<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    /**
     * Show import dashboard.
     */
    public function index()
    {
        return view('pages.admin.import.index');
    }

    /**
     * Download sample CSV template.
     */
    public function downloadTemplate(string $type)
    {
        $templates = [
            'residents' => $this->getResidentsTemplate(),
            'families' => $this->getFamiliesTemplate(),
        ];

        if (!isset($templates[$type])) {
            abort(404);
        }

        $filename = "template_{$type}_" . date('Y-m-d') . ".csv";
        
        return response($templates[$type], 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /**
     * Preview import data.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
            'type' => ['required', 'in:residents,families'],
        ]);

        $file = $request->file('file');
        $type = $request->type;
        
        $data = $this->parseCsv($file->getPathname());
        
        if (empty($data)) {
            return back()->with('error', 'File CSV kosong atau format tidak valid.');
        }

        // Store in session for actual import
        session(['import_data' => $data, 'import_type' => $type]);

        return view('pages.admin.import.preview', [
            'data' => array_slice($data, 0, 50), // Preview first 50 rows
            'totalRows' => count($data),
            'type' => $type,
        ]);
    }

    /**
     * Process the actual import.
     */
    public function process(Request $request)
    {
        $data = session('import_data');
        $type = session('import_type');

        if (!$data || !$type) {
            return redirect()->route('admin.import.index')
                ->with('error', 'Data import tidak ditemukan. Silakan upload ulang.');
        }

        $user = auth()->user();
        $villageId = $user->village_id;

        if (!$villageId && !$user->isSuperAdmin()) {
            return back()->with('error', 'Anda harus terkait dengan desa untuk mengimport data.');
        }

        try {
            DB::beginTransaction();

            if ($type === 'residents') {
                $result = $this->importResidents($data, $villageId);
            } else {
                $result = $this->importFamilies($data, $villageId);
            }

            DB::commit();

            // Clear session
            session()->forget(['import_data', 'import_type']);

            return redirect()->route('admin.import.index')
                ->with('success', "Import berhasil! {$result['success']} data berhasil diimport, {$result['failed']} gagal.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Import residents from parsed data.
     */
    private function importResidents(array $data, ?int $villageId): array
    {
        $success = 0;
        $failed = 0;

        foreach ($data as $row) {
            $validator = Validator::make($row, [
                'nik' => 'required|max:16|unique:residents,nik',
                'nama' => 'required|max:255',
                'jenis_kelamin' => 'required|in:L,P,laki-laki,perempuan,male,female',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
            ]);

            if ($validator->fails()) {
                $failed++;
                continue;
            }

            $gender = strtolower($row['jenis_kelamin']);
            $gender = in_array($gender, ['l', 'laki-laki', 'male']) ? 'male' : 'female';

            Resident::create([
                'nik' => $row['nik'],
                'name' => $row['nama'],
                'gender' => $gender,
                'birth_place' => $row['tempat_lahir'],
                'birth_date' => $row['tanggal_lahir'],
                'address' => $row['alamat'] ?? null,
                'religion' => $row['agama'] ?? null,
                'marital_status' => $this->mapMaritalStatus($row['status_pernikahan'] ?? 'single'),
                'occupation' => $row['pekerjaan'] ?? null,
                'phone' => $row['telepon'] ?? null,
                'status' => 'active',
                'village_id' => $villageId,
            ]);

            $success++;
        }

        return ['success' => $success, 'failed' => $failed];
    }

    /**
     * Import families from parsed data.
     */
    private function importFamilies(array $data, ?int $villageId): array
    {
        $success = 0;
        $failed = 0;

        foreach ($data as $row) {
            $validator = Validator::make($row, [
                'no_kk' => 'required|size:16|unique:families,kk_number',
                'kepala_keluarga' => 'required|max:255',
                'alamat' => 'required',
            ]);

            if ($validator->fails()) {
                $failed++;
                continue;
            }

            Family::create([
                'kk_number' => $row['no_kk'],
                'head_name' => $row['kepala_keluarga'],
                'address' => $row['alamat'],
                'rt' => $row['rt'] ?? null,
                'rw' => $row['rw'] ?? null,
                'village_id' => $villageId,
                'status' => 'active',
            ]);

            $success++;
        }

        return ['success' => $success, 'failed' => $failed];
    }

    /**
     * Parse CSV file.
     */
    private function parseCsv(string $path): array
    {
        $data = [];
        $headers = [];

        if (($handle = fopen($path, 'r')) !== false) {
            $rowNum = 0;
            while (($row = fgetcsv($handle, 0, ',')) !== false) {
                // Skip BOM
                if ($rowNum === 0 && isset($row[0])) {
                    $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);
                }

                if ($rowNum === 0) {
                    // First row is headers
                    $headers = array_map(function($h) {
                        return strtolower(trim(str_replace([' ', '.'], '_', $h)));
                    }, $row);
                } else {
                    // Data rows
                    if (count($row) === count($headers)) {
                        $data[] = array_combine($headers, $row);
                    }
                }
                $rowNum++;
            }
            fclose($handle);
        }

        return $data;
    }

    /**
     * Map marital status from various inputs.
     */
    private function mapMaritalStatus(?string $status): string
    {
        $status = strtolower(trim($status ?? ''));
        
        return match(true) {
            in_array($status, ['menikah', 'married', 'kawin']) => 'married',
            in_array($status, ['cerai', 'divorced']) => 'divorced',
            in_array($status, ['janda', 'duda', 'widowed']) => 'widowed',
            default => 'single',
        };
    }

    /**
     * Generate residents CSV template.
     */
    private function getResidentsTemplate(): string
    {
        $bom = chr(0xEF).chr(0xBB).chr(0xBF);
        $headers = "NIK,Nama,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Alamat,Agama,Status Pernikahan,Pekerjaan,Telepon\n";
        $sample = "1234567890123456,John Doe,L,Jakarta,1990-01-15,Jl. Contoh No. 1,Islam,Belum Menikah,Wiraswasta,08123456789\n";
        
        return $bom . $headers . $sample;
    }

    /**
     * Generate families CSV template.
     */
    private function getFamiliesTemplate(): string
    {
        $bom = chr(0xEF).chr(0xBB).chr(0xBF);
        $headers = "No KK,Kepala Keluarga,Alamat,RT,RW\n";
        $sample = "1234567890123456,John Doe,Jl. Contoh No. 1,001,001\n";
        
        return $bom . $headers . $sample;
    }
}
