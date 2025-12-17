# 📦 Panduan Instalasi - Desa Pintar

Dokumen ini berisi panduan lengkap untuk menginstall dan menjalankan aplikasi Desa Pintar.

---

## 📋 Daftar Isi

1. [Persyaratan Sistem](#persyaratan-sistem)
2. [Instalasi](#instalasi)
3. [Konfigurasi Environment](#konfigurasi-environment)
4. [Database Setup](#database-setup)
5. [Menjalankan Aplikasi](#menjalankan-aplikasi)
6. [Troubleshooting](#troubleshooting)

---

## 💻 Persyaratan Sistem

### Software yang Dibutuhkan

| Software | Versi Minimum | Keterangan                      |
| -------- | ------------- | ------------------------------- |
| PHP      | >= 8.2        | Dengan ekstensi yang dibutuhkan |
| Composer | >= 2.0        | PHP dependency manager          |
| Node.js  | >= 18.0       | JavaScript runtime              |
| npm      | >= 9.0        | Node package manager            |
| MySQL    | >= 8.0        | Database server                 |
| Git      | >= 2.0        | Version control                 |

### Ekstensi PHP yang Dibutuhkan

```
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- PDO MySQL Extension
- Tokenizer PHP Extension
- XML PHP Extension
- ZIP PHP Extension
- GD PHP Extension (untuk image processing)
```

### Cek Ekstensi PHP

```bash
php -m | grep -E "pdo|mysql|gd|mbstring|curl|json|xml"
```

---

## 🚀 Instalasi

### Langkah 1: Clone Repository

```bash
# Clone dari repository
git clone <repository-url> desa-pintar
cd desa-pintar

# Atau download dan extract ZIP
```

### Langkah 2: Install PHP Dependencies

```bash
composer install
```

Jika ada error memory, gunakan:

```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

### Langkah 3: Install Node.js Dependencies

```bash
npm install
```

### Langkah 4: Buat File Environment

```bash
# Copy file .env.example ke .env
cp .env.example .env

# Untuk Windows
copy .env.example .env
```

### Langkah 5: Generate Application Key

```bash
php artisan key:generate
```

---

## ⚙️ Konfigurasi Environment

Buka file `.env` dan sesuaikan konfigurasi berikut:

### Konfigurasi Aplikasi

```env
APP_NAME="Desa Pintar"
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000
```

### Konfigurasi Database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_pintar
DB_USERNAME=root
DB_PASSWORD=password_anda
```

### Konfigurasi Email (Opsional)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@desapintar.id"
MAIL_FROM_NAME="${APP_NAME}"
```

> **Note:** Untuk Gmail, gunakan [App Password](https://support.google.com/accounts/answer/185833), bukan password akun.

### Konfigurasi Session

```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

## 🗃️ Database Setup

### Langkah 1: Buat Database

```bash
# Login ke MySQL
mysql -u root -p

# Buat database baru
CREATE DATABASE desa_pintar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Keluar dari MySQL
exit;
```

Atau menggunakan phpMyAdmin/GUI tool lainnya.

### Langkah 2: Jalankan Migrasi

```bash
php artisan migrate
```

Output yang diharapkan:

```
INFO  Running migrations.

2025_01_01_000000_create_users_table ............ DONE
2025_01_01_000001_create_roles_table ............ DONE
...
```

### Langkah 3: Seed Data Awal

```bash
# Seed semua data awal
php artisan db:seed
```

Ini akan membuat:

-   Roles (superadmin, admin, user)
-   User default
-   Data sample (jika ada)

### Langkah 4: Seed Permissions (Opsional)

```bash
php artisan tinker

# Di dalam tinker
>>> \App\Models\Permission::seedDefaults()
>>> exit
```

---

## ▶️ Menjalankan Aplikasi

### Development Mode

Buka 2 terminal:

**Terminal 1 - Laravel Server:**

```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server:**

```bash
npm run dev
```

Aplikasi akan berjalan di: **http://localhost:8000**

### Production Mode

```bash
# Build assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache

# Jalankan dengan web server (Apache/Nginx)
```

### Storage Link

```bash
php artisan storage:link
```

Ini akan membuat symbolic link dari `public/storage` ke `storage/app/public`.

---

## 🔐 Akun Default

Setelah seeding, Anda dapat login dengan:

| Role       | Email                  | Password |
| ---------- | ---------------------- | -------- |
| Superadmin | superadmin@example.com | password |
| Admin      | admin@example.com      | password |
| User       | user@example.com       | password |

> **⚠️ Penting:** Segera ganti password default setelah login pertama!

---

## 🔧 Troubleshooting

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1049] Unknown database"

Pastikan database sudah dibuat:

```bash
mysql -u root -p -e "CREATE DATABASE desa_pintar"
```

### Error: "Permission denied" pada storage

```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache

# Windows - jalankan sebagai Administrator
```

### Error: "Vite manifest not found"

```bash
npm run build
# atau untuk development
npm run dev
```

### Error: "Class not found"

```bash
composer dump-autoload
php artisan clear-compiled
```

### Clear All Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📁 Struktur Folder

```
desa-pintar/
├── app/                    # Kode aplikasi
│   ├── Http/Controllers/   # Controllers
│   ├── Models/             # Eloquent Models
│   └── Mail/               # Mailable classes
├── config/                 # Konfigurasi
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── public/                 # Public assets
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript
├── routes/
│   ├── web.php             # Web routes
│   └── api.php             # API routes
├── storage/                # File storage
├── .env                    # Environment config
└── composer.json           # PHP dependencies
```

---

## 🔄 Update Aplikasi

```bash
# Pull latest code
git pull origin main

# Update dependencies
composer install
npm install

# Run new migrations
php artisan migrate

# Rebuild assets
npm run build

# Clear cache
php artisan optimize:clear
```

---

## ❓ Bantuan

Jika mengalami masalah, periksa:

1. **Log Laravel:** `storage/logs/laravel.log`
2. **Console Browser:** F12 → Console
3. **PHP Error Log:** Periksa konfigurasi `php.ini`

---

_Dokumen ini adalah bagian dari dokumentasi Desa Pintar._
