<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    protected string $backupPath = 'backups';

    /**
     * Show backup management page.
     */
    public function index()
    {
        $backups = $this->getBackupFiles();

        return view('pages.admin.backup.index', compact('backups'));
    }

    /**
     * Create a new backup.
     */
    public function create()
    {
        try {
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            $path = storage_path('app/' . $this->backupPath . '/' . $filename);

            // Ensure directory exists
            if (!File::exists(dirname($path))) {
                File::makeDirectory(dirname($path), 0755, true);
            }

            // Get database connection info
            $host = config('database.connections.mysql.host');
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');

            // Export using mysqldump
            $command = sprintf(
                'mysqldump -h %s -u %s %s %s > "%s"',
                escapeshellarg($host),
                escapeshellarg($username),
                $password ? '-p' . escapeshellarg($password) : '',
                escapeshellarg($database),
                $path
            );

            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                // Fallback: Manual SQL export
                $this->manualBackup($path);
            }

            return redirect()->route('admin.backup.index')
                ->with('success', "Backup berhasil dibuat: {$filename}");

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    /**
     * Download a backup file.
     */
    public function download(string $filename)
    {
        $path = storage_path('app/' . $this->backupPath . '/' . $filename);

        if (!File::exists($path)) {
            return back()->with('error', 'File backup tidak ditemukan.');
        }

        return response()->download($path, $filename, [
            'Content-Type' => 'application/sql',
        ]);
    }

    /**
     * Delete a backup file.
     */
    public function destroy(string $filename)
    {
        $path = storage_path('app/' . $this->backupPath . '/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
            return back()->with('success', 'Backup berhasil dihapus.');
        }

        return back()->with('error', 'File backup tidak ditemukan.');
    }

    /**
     * Get list of backup files.
     */
    protected function getBackupFiles(): array
    {
        $path = storage_path('app/' . $this->backupPath);

        if (!File::exists($path)) {
            return [];
        }

        $files = File::files($path);
        $backups = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $backups[] = [
                    'name' => $file->getFilename(),
                    'size' => $this->formatBytes($file->getSize()),
                    'date' => date('d M Y H:i', $file->getMTime()),
                ];
            }
        }

        // Sort by date descending
        usort($backups, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return $backups;
    }

    /**
     * Format bytes to human readable.
     */
    protected function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }

    /**
     * Manual backup fallback.
     */
    protected function manualBackup(string $path): void
    {
        $tables = DB::select('SHOW TABLES');
        $database = config('database.connections.mysql.database');
        $key = 'Tables_in_' . $database;

        $sql = "-- Desa Pintar Database Backup\n";
        $sql .= "-- Date: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- -------------------------\n\n";

        foreach ($tables as $table) {
            $tableName = $table->$key;
            
            // Get CREATE TABLE statement
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $createTable[0]->{'Create Table'} . ";\n\n";

            // Get data (limit to avoid memory issues)
            $rows = DB::table($tableName)->limit(10000)->get();
            
            foreach ($rows as $row) {
                $values = array_map(function ($value) {
                    if ($value === null) {
                        return 'NULL';
                    }
                    return "'" . addslashes($value) . "'";
                }, (array) $row);

                $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
            }

            $sql .= "\n";
        }

        File::put($path, $sql);
    }
}
