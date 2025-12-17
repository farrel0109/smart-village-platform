<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\LetterRequest;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    /**
     * Show reports dashboard.
     */
    public function index()
    {
        return view('pages.admin.reports.index');
    }

    /**
     * Export residents as CSV.
     */
    public function exportResidents(Request $request)
    {
        $user = auth()->user();

        $query = Resident::with('village', 'family');

        // Filter by village for non-superadmin
        if (!$user->isSuperAdmin() && $user->village_id) {
            $query->where('village_id', $user->village_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $residents = $query->orderBy('name')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data_penduduk_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($residents) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header row
            fputcsv($file, [
                'No', 'NIK', 'Nama', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir',
                'Agama', 'Status Pernikahan', 'Pekerjaan', 'Alamat', 'Telepon', 
                'Status', 'No. KK', 'Desa'
            ]);

            $no = 1;
            foreach ($residents as $resident) {
                fputcsv($file, [
                    $no++,
                    $resident->nik,
                    $resident->name,
                    $resident->gender === 'male' ? 'Laki-laki' : 'Perempuan',
                    $resident->birth_place,
                    $resident->birth_date?->format('d/m/Y'),
                    ucfirst($resident->religion ?? '-'),
                    $this->getMaritalStatusLabel($resident->marital_status),
                    $resident->occupation ?? '-',
                    $resident->address,
                    $resident->phone ?? '-',
                    $this->getStatusLabel($resident->status),
                    $resident->family?->kk_number ?? '-',
                    $resident->village?->name ?? '-',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export families as CSV.
     */
    public function exportFamilies(Request $request)
    {
        $user = auth()->user();

        $query = Family::with('village', 'members');

        if (!$user->isSuperAdmin() && $user->village_id) {
            $query->where('village_id', $user->village_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $families = $query->withCount('members')->orderBy('head_name')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data_keluarga_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($families) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'No', 'No. KK', 'Kepala Keluarga', 'Alamat', 'RT', 'RW', 
                'Jumlah Anggota', 'Status', 'Desa'
            ]);

            $no = 1;
            foreach ($families as $family) {
                fputcsv($file, [
                    $no++,
                    $family->kk_number,
                    $family->head_name,
                    $family->address,
                    $family->rt ?? '-',
                    $family->rw ?? '-',
                    $family->members_count,
                    $family->status === 'active' ? 'Aktif' : 'Tidak Aktif',
                    $family->village?->name ?? '-',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export letters as CSV.
     */
    public function exportLetters(Request $request)
    {
        $user = auth()->user();

        $query = LetterRequest::with(['user', 'letterType', 'village', 'processor']);

        if (!$user->isSuperAdmin() && $user->village_id) {
            $query->where('village_id', $user->village_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $letters = $query->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data_surat_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($letters) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'No', 'Nomor Pengajuan', 'Jenis Surat', 'Pemohon', 'Keperluan',
                'Status', 'Diproses Oleh', 'Tanggal Pengajuan', 'Tanggal Diproses', 'Desa'
            ]);

            $no = 1;
            foreach ($letters as $letter) {
                fputcsv($file, [
                    $no++,
                    $letter->request_number,
                    $letter->letterType?->name ?? '-',
                    $letter->user?->name ?? '-',
                    $letter->purpose ?? '-',
                    $letter->getStatusLabel(),
                    $letter->processor?->name ?? '-',
                    $letter->created_at->format('d/m/Y H:i'),
                    $letter->processed_at?->format('d/m/Y H:i') ?? '-',
                    $letter->village?->name ?? '-',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    private function getMaritalStatusLabel(?string $status): string
    {
        return match($status) {
            'single' => 'Belum Menikah',
            'married' => 'Menikah',
            'divorced' => 'Cerai',
            'widowed' => 'Janda/Duda',
            default => '-',
        };
    }

    private function getStatusLabel(?string $status): string
    {
        return match($status) {
            'active' => 'Aktif',
            'moved' => 'Pindah',
            'deceased' => 'Meninggal',
            default => '-',
        };
    }
}
