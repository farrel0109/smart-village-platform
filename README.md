# 🏛️ Desa Pintar

Sistem Administrasi Desa Digital - Solusi lengkap untuk digitalisasi layanan administrasi desa.

---

## � Dokumentasi

| Dokumen                                            | Deskripsi                   |
| -------------------------------------------------- | --------------------------- |
| [� INSTALLATION.md](documentation/INSTALLATION.md) | Panduan instalasi lengkap   |
| [✨ FEATURES.md](documentation/FEATURES.md)        | Daftar dan penjelasan fitur |

---

## � Quick Start

```bash
# Install dependencies
composer install && npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate --seed

# Run
php artisan serve
npm run dev
```

Buka: **http://localhost:8000**

---

## � Default Login

| Role       | Email                  | Password |
| ---------- | ---------------------- | -------- |
| Superadmin | superadmin@example.com | password |
| Admin      | admin@example.com      | password |

---

## �️ Tech Stack

-   **Laravel 11** - PHP Framework
-   **Tailwind CSS** - Styling
-   **Alpine.js** - JavaScript
-   **MySQL** - Database
-   **Vite** - Build Tool

---

## 📄 Lisensi

MIT License
