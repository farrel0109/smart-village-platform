# ✨ Daftar Fitur - Desa Pintar

Dokumen ini berisi penjelasan detail semua fitur yang tersedia di aplikasi Desa Pintar.

---

## 📋 Daftar Isi

1. [Autentikasi & Keamanan](#autentikasi--keamanan)
2. [Dashboard](#dashboard)
3. [Manajemen Penduduk](#manajemen-penduduk)
4. [Manajemen Kartu Keluarga](#manajemen-kartu-keluarga)
5. [Layanan Surat Menyurat](#layanan-surat-menyurat)
6. [Pengumuman](#pengumuman)
7. [Notifikasi](#notifikasi)
8. [Laporan & Ekspor](#laporan--ekspor)
9. [Import Data](#import-data)
10. [Pengaturan Sistem](#pengaturan-sistem)
11. [Backup & Restore](#backup--restore)
12. [API Mobile](#api-mobile)
13. [Dark Mode](#dark-mode)

---

## 🔐 Autentikasi & Keamanan

### Login & Register

-   **Login** - Masuk dengan email dan password
-   **Register** - Pendaftaran warga baru dengan approval admin
-   **Forgot Password** - Reset password via email
-   **Logout** - Keluar dari sistem

### Two-Factor Authentication (2FA)

Fitur keamanan tambahan dengan verifikasi 2 langkah:

-   **Aktivasi 2FA** - Enable dari halaman profil
-   **Verifikasi** - Masukkan kode 6 digit saat login
-   **Nonaktifkan** - Disable dengan konfirmasi password

**Cara Mengaktifkan:**

1. Buka `/two-factor`
2. Masukkan password
3. Klik "Aktifkan 2FA"
4. Simpan kode rahasia

### Role & Permission

| Role           | Akses                                 |
| -------------- | ------------------------------------- |
| **Superadmin** | Akses penuh, kelola desa, kelola role |
| **Admin**      | Kelola penduduk, surat, pengumuman    |
| **User**       | Dashboard pribadi, ajukan surat       |

---

## 📊 Dashboard

### Admin Dashboard (`/admin/dashboard`)

Menampilkan ringkasan statistik:

-   **Total Penduduk** - Jumlah penduduk terdaftar
-   **Total Keluarga** - Jumlah KK terdaftar
-   **Surat Pending** - Pengajuan yang menunggu
-   **Surat Selesai** - Total surat selesai bulan ini

### User Dashboard (`/dashboard`)

Dashboard untuk warga:

-   **Salam Personalized** - "Selamat datang, [Nama]"
-   **Statistik Surat Saya** - Total, pending, proses, selesai
-   **Riwayat Pengajuan** - 5 surat terakhir
-   **Pengumuman Terbaru** - 5 pengumuman terkini

---

## 👥 Manajemen Penduduk

**URL:** `/admin/residents`

### Fitur CRUD

| Aksi       | Deskripsi                                    |
| ---------- | -------------------------------------------- |
| **Lihat**  | Daftar penduduk dengan pagination dan search |
| **Tambah** | Form input data penduduk baru                |
| **Edit**   | Ubah data penduduk existing                  |
| **Hapus**  | Hapus data penduduk                          |

### Data Penduduk

```
- NIK (16 digit, unik)
- Nama Lengkap
- Jenis Kelamin
- Tempat & Tanggal Lahir
- Agama
- Status Pernikahan
- Pekerjaan
- Alamat
- Nomor Telepon
- Foto (opsional)
```

### Upload Foto Penduduk

-   Format: JPG, PNG, GIF
-   Maksimal: 2MB
-   Lokasi: `storage/app/public/residents/`

### Pencarian & Filter

-   Cari berdasarkan nama/NIK
-   Filter status (aktif/tidak aktif)
-   Pagination 15 item per halaman

---

## 👨‍👩‍👧‍👦 Manajemen Kartu Keluarga

**URL:** `/admin/families`

### Fitur

| Aksi               | Deskripsi                  |
| ------------------ | -------------------------- |
| **Daftar KK**      | Lihat semua Kartu Keluarga |
| **Detail KK**      | Lihat anggota keluarga     |
| **Tambah KK**      | Buat KK baru               |
| **Edit KK**        | Ubah data KK               |
| **Kelola Anggota** | Tambah/hapus anggota       |

### Data Keluarga

```
- Nomor KK (16 digit, unik)
- Nama Kepala Keluarga
- Alamat
- RT/RW
- Status
```

### Manajemen Anggota

Dari halaman detail KK:

-   **Tambah Anggota** - Pilih penduduk untuk dimasukkan
-   **Hapus Anggota** - Keluarkan dari KK
-   **Set Kepala** - Tentukan kepala keluarga

---

## 📝 Layanan Surat Menyurat

### Jenis Surat (`/admin/letter-types`)

Mengelola jenis-jenis surat:

-   Surat Keterangan Usaha (SKU)
-   Surat Keterangan Domisili
-   Surat Pengantar SKCK
-   Surat Keterangan Tidak Mampu
-   Dan lainnya...

### Pengajuan Surat

**User:** `/letters/create`

1. Pilih jenis surat
2. Isi keperluan/tujuan
3. Upload dokumen pendukung (opsional)
4. Submit pengajuan

**Admin:** `/admin/letters`

### Workflow Status

```
┌──────────┐     ┌────────────┐     ┌───────────┐
│ PENDING  │ ──► │ PROCESSING │ ──► │ COMPLETED │
└──────────┘     └────────────┘     └───────────┘
     │                                     │
     └────────────── REJECTED ◄────────────┘
```

| Status     | Warna  | Deskripsi              |
| ---------- | ------ | ---------------------- |
| Pending    | Kuning | Menunggu diproses      |
| Processing | Biru   | Sedang diproses admin  |
| Completed  | Hijau  | Selesai, bisa download |
| Rejected   | Merah  | Ditolak dengan alasan  |

### Generate PDF

Setelah surat selesai:

1. Klik tombol Download PDF
2. Surat tergenerate dengan format resmi
3. Termasuk kop surat, nomor, dan tanda tangan

### Template Surat (`/admin/letter-templates`)

Fitur template dinamis:

-   Buat template dengan placeholder
-   Placeholder: `{{nama}}`, `{{nik}}`, `{{tanggal}}`, dll
-   Preview template dengan data sample

---

## 📣 Pengumuman

**URL:** `/admin/announcements`

### Fitur CRUD

| Aksi               | Deskripsi              |
| ------------------ | ---------------------- |
| **Daftar**         | Lihat semua pengumuman |
| **Buat**           | Tulis pengumuman baru  |
| **Edit**           | Ubah pengumuman        |
| **Hapus**          | Hapus pengumuman       |
| **Toggle Publish** | Publish/draft          |

### Data Pengumuman

```
- Judul
- Konten (rich text)
- Kategori (Umum, Penting, Acara)
- Gambar (opsional)
- Status Publish
- Tanggal Publish
```

### Kategori

| Kategori | Badge   | Deskripsi         |
| -------- | ------- | ----------------- |
| Umum     | Abu-abu | Informasi biasa   |
| Penting  | Merah   | Pengumuman urgent |
| Acara    | Biru    | Event/kegiatan    |

### Tampilan Publik

Warga dapat melihat di:

-   `/announcements` - Daftar pengumuman
-   `/announcements/{id}` - Detail pengumuman

---

## 🔔 Notifikasi

**URL:** `/notifications`

### Fitur

-   **Dropdown Bell** - Navbar notification bell
-   **Badge Count** - Jumlah notifikasi belum dibaca
-   **Mark as Read** - Tandai sudah dibaca
-   **Mark All Read** - Tandai semua dibaca

### Jenis Notifikasi

| Trigger              | Notifikasi                           |
| -------------------- | ------------------------------------ |
| Status surat berubah | "Surat Anda sedang diproses"         |
| User diapprove       | "Selamat! Akun Anda telah disetujui" |
| Pengumuman baru      | "Ada pengumuman baru dari desa"      |

---

## 📊 Laporan & Ekspor

**URL:** `/admin/reports`

### Export ke CSV

| Data         | File              | Kolom                               |
| ------------ | ----------------- | ----------------------------------- |
| **Penduduk** | `residents_*.csv` | NIK, Nama, Gender, TTL, Alamat, dll |
| **Keluarga** | `families_*.csv`  | No KK, Kepala, Alamat, Anggota      |
| **Surat**    | `letters_*.csv`   | No Request, Jenis, Status, Tanggal  |

### Filter Export

-   Filter berdasarkan status
-   Filter berdasarkan tanggal
-   Filter berdasarkan desa (superadmin)

### Format CSV

-   Encoding: UTF-8 dengan BOM
-   Delimiter: Koma (,)
-   Compatible: Excel, Google Sheets

---

## 📥 Import Data

**URL:** `/admin/import`

### Import Penduduk

1. Download template CSV
2. Isi data sesuai format
3. Upload file CSV
4. Preview data
5. Konfirmasi import

**Format Kolom:**

```
NIK, Nama, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Alamat, Agama, Status Pernikahan, Pekerjaan, Telepon
```

### Import Keluarga

**Format Kolom:**

```
No KK, Kepala Keluarga, Alamat, RT, RW
```

### Validasi

-   NIK/No KK harus 16 digit
-   Data duplikat akan diskip
-   Hasil: "X berhasil, Y gagal"

---

## ⚙️ Pengaturan Sistem

**URL:** `/admin/settings`

### Pengaturan Desa

| Setting   | Deskripsi            |
| --------- | -------------------- |
| Nama Desa | Nama resmi desa      |
| Kecamatan | Nama kecamatan       |
| Kabupaten | Nama kabupaten       |
| Provinsi  | Nama provinsi        |
| Kode Pos  | Kode pos desa        |
| Telepon   | Nomor telepon kantor |

### Logo Desa

-   Upload logo desa
-   Format: PNG, JPG
-   Digunakan di kop surat dan navbar

### Pengaturan Aplikasi

| Setting         | Deskripsi         |
| --------------- | ----------------- |
| App Name        | Nama aplikasi     |
| App Description | Deskripsi singkat |

---

## 💾 Backup & Restore

**URL:** `/admin/backup`

### Fitur Backup

| Aksi            | Deskripsi         |
| --------------- | ----------------- |
| **Buat Backup** | Generate file SQL |
| **Download**    | Unduh file backup |
| **Hapus**       | Hapus backup lama |

### Informasi Backup

-   Nama file: `backup_YYYY-MM-DD_HH-mm-ss.sql`
-   Lokasi: `storage/app/backups/`
-   Format: SQL dump

### Restore

Untuk restore, import file SQL via:

-   phpMyAdmin
-   Command line: `mysql -u user -p database < backup.sql`

---

## 📱 API Mobile

**Base URL:** `/api`

### Autentikasi

```bash
# Login
POST /api/login
{
  "email": "user@example.com",
  "password": "password",
  "device_name": "mobile"
}

# Response
{
  "token": "1|abcdef..."
}
```

### Endpoint Tersedia

| Method | Endpoint         | Auth | Deskripsi         |
| ------ | ---------------- | ---- | ----------------- |
| POST   | `/login`         | ❌   | Login & get token |
| GET    | `/user`          | ✅   | Profile user      |
| POST   | `/logout`        | ✅   | Revoke token      |
| GET    | `/letters`       | ✅   | Daftar surat saya |
| POST   | `/letters`       | ✅   | Ajukan surat      |
| GET    | `/letters/types` | ✅   | Jenis surat       |
| GET    | `/announcements` | ❌   | Pengumuman publik |

### Header Authorization

```
Authorization: Bearer {token}
```

---

## 🌙 Dark Mode

### Toggle

Klik icon 🌙/☀️ di navbar untuk switch mode.

### Persistensi

Preferensi disimpan di `localStorage` browser.

### Komponen

Dark mode diterapkan pada:

-   Navbar
-   Sidebar
-   Content area
-   Cards & Tables
-   Forms

---

## 📁 Ringkasan URL

### Admin Routes

| URL                       | Fitur              |
| ------------------------- | ------------------ |
| `/admin/dashboard`        | Dashboard Admin    |
| `/admin/residents`        | Manajemen Penduduk |
| `/admin/families`         | Manajemen KK       |
| `/admin/letters`          | Manajemen Surat    |
| `/admin/letter-types`     | Jenis Surat        |
| `/admin/letter-templates` | Template Surat     |
| `/admin/announcements`    | Pengumuman         |
| `/admin/reports`          | Laporan            |
| `/admin/import`           | Import Data        |
| `/admin/settings`         | Pengaturan         |
| `/admin/backup`           | Backup             |
| `/admin/users`            | Manajemen User     |

### User Routes

| URL              | Fitur          |
| ---------------- | -------------- |
| `/dashboard`     | Dashboard User |
| `/my-letters`    | Surat Saya     |
| `/announcements` | Pengumuman     |
| `/profile`       | Profil Saya    |
| `/two-factor`    | Pengaturan 2FA |
| `/notifications` | Notifikasi     |

---

_Dokumen ini adalah bagian dari dokumentasi Desa Pintar._
