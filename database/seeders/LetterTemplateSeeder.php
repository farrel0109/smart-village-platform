<?php

namespace Database\Seeders;

use App\Models\LetterTemplate;
use App\Models\Village;
use Illuminate\Database\Seeder;

class LetterTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $village1 = Village::where('village_code', 'DSA001')->first();
        
        $templates = [
            [
                'name' => 'Template Surat Keterangan Domisili',
                'letter_type_code' => 'SKD',
                'content' => '<div style="text-align: center; margin-bottom: 20px;">
    <h3 style="margin: 0;">PEMERINTAH KABUPATEN BONE</h3>
    <h3 style="margin: 0;">KECAMATAN TANETE RIATTANG</h3>
    <h2 style="margin: 10px 0;">DESA SUKAMAJU</h2>
    <hr style="border: 2px solid #000; margin: 10px 0;">
</div>

<div style="text-align: center; margin: 30px 0;">
    <h3 style="text-decoration: underline; margin: 0;">SURAT KETERANGAN DOMISILI</h3>
    <p style="margin: 5px 0;">Nomor: {{letter_number}}</p>
</div>

<p>Yang bertanda tangan di bawah ini Kepala Desa Sukamaju Kecamatan Tanete Riattang Kabupaten Bone, menerangkan bahwa:</p>

<table style="margin: 20px 0; width: 100%;">
    <tr>
        <td style="width: 200px;">Nama</td>
        <td style="width: 20px;">:</td>
        <td>{{name}}</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{nik}}</td>
    </tr>
    <tr>
        <td>Tempat/Tgl Lahir</td>
        <td>:</td>
        <td>{{birth_place}}, {{birth_date}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{gender}}</td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{occupation}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{address}}</td>
    </tr>
</table>

<p>Adalah benar berdomisili di wilayah Desa Sukamaju sejak {{domicile_since}}.</p>

<p>Surat keterangan ini dibuat untuk keperluan: <strong>{{purpose}}</strong></p>

<p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

<div style="margin-top: 40px; text-align: right;">
    <p>Desa Sukamaju, {{current_date}}</p>
    <p>Kepala Desa Sukamaju</p>
    <br><br><br>
    <p style="text-decoration: underline; font-weight: bold;">{{signed_by}}</p>
</div>',
                'variables' => json_encode([
                    'letter_number' => 'Nomor surat',
                    'name' => 'Nama lengkap',
                    'nik' => 'NIK',
                    'birth_place' => 'Tempat lahir',
                    'birth_date' => 'Tanggal lahir',
                    'gender' => 'Jenis kelamin',
                    'occupation' => 'Pekerjaan',
                    'address' => 'Alamat lengkap',
                    'domicile_since' => 'Domisili sejak',
                    'purpose' => 'Keperluan',
                    'current_date' => 'Tanggal surat',
                    'signed_by' => 'Yang menandatangani'
                ]),
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
            [
                'name' => 'Template Surat Keterangan Usaha',
                'letter_type_code' => 'SKU',
                'content' => '<div style="text-align: center; margin-bottom: 20px;">
    <h3 style="margin: 0;">PEMERINTAH KABUPATEN BONE</h3>
    <h3 style="margin: 0;">KECAMATAN TANETE RIATTANG</h3>
    <h2 style="margin: 10px 0;">DESA SUKAMAJU</h2>
    <hr style="border: 2px solid #000; margin: 10px 0;">
</div>

<div style="text-align: center; margin: 30px 0;">
    <h3 style="text-decoration: underline; margin: 0;">SURAT KETERANGAN USAHA</h3>
    <p style="margin: 5px 0;">Nomor: {{letter_number}}</p>
</div>

<p>Yang bertanda tangan di bawah ini Kepala Desa Sukamaju Kecamatan Tanete Riattang Kabupaten Bone, menerangkan bahwa:</p>

<table style="margin: 20px 0; width: 100%;">
    <tr>
        <td style="width: 200px;">Nama</td>
        <td style="width: 20px;">:</td>
        <td>{{name}}</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{nik}}</td>
    </tr>
    <tr>
        <td>Tempat/Tgl Lahir</td>
        <td>:</td>
        <td>{{birth_place}}, {{birth_date}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{gender}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{address}}</td>
    </tr>
</table>

<p>Adalah benar warga Desa Sukamaju yang memiliki usaha dengan keterangan sebagai berikut:</p>

<table style="margin: 20px 0; width: 100%;">
    <tr>
        <td style="width: 200px;">Jenis Usaha</td>
        <td style="width: 20px;">:</td>
        <td>{{business_type}}</td>
    </tr>
    <tr>
        <td>Nama Usaha</td>
        <td>:</td>
        <td>{{business_name}}</td>
    </tr>
    <tr>
        <td>Alamat Usaha</td>
        <td>:</td>
        <td>{{business_address}}</td>
    </tr>
    <tr>
        <td>Mulai Usaha</td>
        <td>:</td>
        <td>{{business_since}}</td>
    </tr>
</table>

<p>Surat keterangan ini dibuat untuk keperluan: <strong>{{purpose}}</strong></p>

<p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

<div style="margin-top: 40px; text-align: right;">
    <p>Desa Sukamaju, {{current_date}}</p>
    <p>Kepala Desa Sukamaju</p>
    <br><br><br>
    <p style="text-decoration: underline; font-weight: bold;">{{signed_by}}</p>
</div>',
                'variables' => json_encode([
                    'letter_number' => 'Nomor surat',
                    'name' => 'Nama lengkap',
                    'nik' => 'NIK',
                    'birth_place' => 'Tempat lahir',
                    'birth_date' => 'Tanggal lahir',
                    'gender' => 'Jenis kelamin',
                    'address' => 'Alamat lengkap',
                    'business_type' => 'Jenis usaha',
                    'business_name' => 'Nama usaha',
                    'business_address' => 'Alamat usaha',
                    'business_since' => 'Mulai usaha sejak',
                    'purpose' => 'Keperluan',
                    'current_date' => 'Tanggal surat',
                    'signed_by' => 'Yang menandatangani'
                ]),
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
        ];

        foreach ($templates as $template) {
            LetterTemplate::updateOrCreate(
                [
                    'name' => $template['name'],
                    'village_id' => $template['village_id']
                ],
                $template
            );
        }
    }
}
