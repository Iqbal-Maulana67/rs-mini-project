# 🏥 RS Mini Project

Aplikasi manajemen rumah sakit sederhana berbasis **Laravel**, mencakup fitur transaksi, voucher, laporan harian, dan pengiriman laporan via email.

## 📦 Tech Stack

- Laravel 11+
- PHP >= 8.2
- MySQL / PostgreSQL
- Composer
- Node.js & NPM
- Bootstrap / Tailwind
- SMTP Gmail

## ⚙️ Requirements

Pastikan sudah terinstall:

- PHP >= 8.2
- Composer
- PostgreSQL
- Node.js >= 18
- Git

# Cara Menjalankan Project

```
git clone https://github.com/Iqbal-Maulana67/rs-mini-project.git
cd rs-mini-project
```

Install Dependency Backend

```
composer install
npm install
```

Generate application key

```
php artisan key:generate

```

Konfigurasi Environtment

1. Database
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rs_mini_project
DB_USERNAME=postgres
DB_PASSWORD=secret
```

2. Email SMTP
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="RS Mini Project"
```

Menjalankan sinkronisasi data dengan API RS Delta Surya
```
php artisan sync:all
```

Menjalankan Seeder
```
php artisan db:seed
```

## Jalankan Aplikasi
```
npm run dev
```

```
php artisan serve
```

## Menjalankan Task Scheduler
```
php artisan schedule:work
```
atau untuk testing
```
php artisan schedule:run
```
