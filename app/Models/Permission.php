<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'group',
    ];

    /**
     * Get the roles that have this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get permissions grouped by group name.
     */
    public static function getGrouped()
    {
        return static::orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');
    }

    /**
     * Seed default permissions.
     */
    public static function seedDefaults(): void
    {
        $permissions = [
            // Residents
            ['name' => 'Lihat Penduduk', 'slug' => 'residents.view', 'group' => 'Penduduk'],
            ['name' => 'Tambah Penduduk', 'slug' => 'residents.create', 'group' => 'Penduduk'],
            ['name' => 'Edit Penduduk', 'slug' => 'residents.edit', 'group' => 'Penduduk'],
            ['name' => 'Hapus Penduduk', 'slug' => 'residents.delete', 'group' => 'Penduduk'],

            // Letters
            ['name' => 'Lihat Surat', 'slug' => 'letters.view', 'group' => 'Surat'],
            ['name' => 'Proses Surat', 'slug' => 'letters.process', 'group' => 'Surat'],
            ['name' => 'Cetak Surat', 'slug' => 'letters.print', 'group' => 'Surat'],

            // Families
            ['name' => 'Lihat Keluarga', 'slug' => 'families.view', 'group' => 'Keluarga'],
            ['name' => 'Tambah Keluarga', 'slug' => 'families.create', 'group' => 'Keluarga'],
            ['name' => 'Edit Keluarga', 'slug' => 'families.edit', 'group' => 'Keluarga'],
            ['name' => 'Hapus Keluarga', 'slug' => 'families.delete', 'group' => 'Keluarga'],

            // Reports
            ['name' => 'Lihat Laporan', 'slug' => 'reports.view', 'group' => 'Laporan'],
            ['name' => 'Export Data', 'slug' => 'reports.export', 'group' => 'Laporan'],

            // Settings
            ['name' => 'Kelola Pengaturan', 'slug' => 'settings.manage', 'group' => 'Sistem'],
            ['name' => 'Kelola Backup', 'slug' => 'backup.manage', 'group' => 'Sistem'],
            ['name' => 'Kelola Pengguna', 'slug' => 'users.manage', 'group' => 'Sistem'],
        ];

        foreach ($permissions as $permission) {
            static::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
