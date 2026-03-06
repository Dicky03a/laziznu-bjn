# Panduan Database Backup & Restore

## Daftar Isi

1. [Konfigurasi Backup](#konfigurasi-backup)
2. [Cara Membuat Backup](#cara-membuat-backup)
3. [Automasi Backup](#automasi-backup)
4. [Cara Restore Database](#cara-restore-database)
5. [Lokasi Backup Files](#lokasi-backup-files)
6. [Troubleshooting](#troubleshooting)

---

## Konfigurasi Backup

### File Konfigurasi Utama

- **Lokasi**: `config/backup.php`
- **Package**: `spatie/laravel-backup` v9.3.6

### Setting Penting yang Sudah Dikonfigurasi

```php
// config/backup.php

'backup' => [
    'name' => env('APP_NAME', 'laravel-backup'),

    'source' => [
        'files' => [
            'include' => [base_path()],
            'exclude' => [
                base_path('vendor'),      // Exclude composer dependencies
                base_path('node_modules'), // Exclude npm packages
            ],
        ],

        'databases' => [
            env('DB_CONNECTION', 'mysql'), // Backup MySQL database
        ],
    ],

    // Gzip compression untuk database dump
    'database_dump_compressor' => \Spatie\DbDumper\Compressors\GzipCompressor::class,

    // Database dump dengan timestamp
    'database_dump_file_timestamp_format' => 'Y-m-d-H-i-s',

    'destination' => [
        'disks' => ['local'], // Simpan ke storage/app/private/
    ],

    'temporary_directory' => storage_path('backup-temp'),

    // Encryption setting (optional)
    'password' => env('BACKUP_ARCHIVE_PASSWORD', null),
    'encryption' => env('BACKUP_ENCRYPTION_ENABLED', false) ? 'default' : false,
],

// Backup Retention Policy
'cleanup' => [
    'default_strategy' => [
        'keep_all_backups_for_days' => 14,         // Simpan semua backup 14 hari
        'keep_daily_backups_for_days' => 30,       // Daily backup untuk 30 hari
        'keep_weekly_backups_for_weeks' => 8,      // Weekly backup untuk 8 minggu
        'keep_monthly_backups_for_months' => 12,   // Monthly backup untuk 1 tahun
        'keep_yearly_backups_for_years' => 3,      // Yearly backup untuk 3 tahun
        'delete_oldest_backups_when_using_more_megabytes_than' => 10000, // Max 10GB
    ],
],

// Monitoring Health
'monitor_backups' => [
    [
        'name' => env('APP_NAME', 'laravel-backup'),
        'disks' => ['local'],
        'health_checks' => [
            \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
            \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 10000,
        ],
    ],
],
```

### Notifikasi Email (Opsional)

Jika ingin menerima notifikasi backup status melalui email:

```php
// config/backup.php
'notifications' => [
    'notifications' => [
        \Spatie\Backup\Notifications\Notifications\BackupHasFailedNotification::class => ['mail'],
        \Spatie\Backup\Notifications\Notifications\BackupWasSuccessfulNotification::class => ['mail'],
        \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFoundNotification::class => ['mail'],
    ],

    'mail' => [
        'to' => env('BACKUP_NOTIFICATION_EMAIL', 'admin@example.com'),
        'from' => [
            'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
            'name' => env('MAIL_FROM_NAME', 'Laravel Backup'),
        ],
    ],
],
```

Tambahkan ke `.env`:

```env
BACKUP_NOTIFICATION_EMAIL=admin@example.com
```

---

## Cara Membuat Backup

### 1. Manual Backup (Satu Kali)

```bash
# Backup aplikasi dan database
php artisan backup:run

# Dengan detail verbose
php artisan backup:run --verbose

# Hanya database (tanpa files)
php artisan backup:run --only-db

# Hanya files (tanpa database)
php artisan backup:run --only-files
```

### 2. Monitoring & Health Check Backup

```bash
# Cek health status backup
php artisan backup:monitor

# Lihat status semua backup yang dikonfigurasi
php artisan backup:list
```

### 3. Cleanup Old Backups

```bash
# Hapus backup lama sesuai retention policy
php artisan backup:clean

# Dengan detail
php artisan backup:clean --verbose
```

### 4. List Semua Backups

```bash
# Lihat semua available backups
php artisan backup:list
```

---

## Automasi Backup

### Setup Cron Job (Recommended)

Tambahkan ini ke server cron configuration:

```bash
# Edit crontab
crontab -e

# Tambahkan line ini untuk backup setiap hari jam 2 pagi
0 2 * * * cd /path/to/laziznu-bjn && php artisan backup:run >> /dev/null 2>&1

# Cleanup setiap hari jam 3 pagi
0 3 * * * cd /path/to/laziznu-bjn && php artisan backup:clean >> /dev/null 2>&1

# Monitor backup health setiap jam
0 * * * * cd /path/to/laziznu-bjn && php artisan backup:monitor >> /dev/null 2>&1
```

### Setup Laravel Scheduler (Alternative)

Jika menggunakan Laravel Scheduler, tambahkan ke `app/Console/Kernel.php`:

```php
// routes/console.php atau app/Console/Kernel.php
use Spatie\Backup\Commands\BackupCommand;
use Spatie\Backup\Commands\CleanupCommand;
use Spatie\Backup\Commands\MonitorCommand;

Schedule::command(BackupCommand::class)->dailyAt('02:00'); // 2 AM daily
Schedule::command(CleanupCommand::class)->dailyAt('03:00'); // 3 AM daily
Schedule::command(MonitorCommand::class)->hourly();          // Every hour
```

Kemudian setup Laravel scheduler cron:

```bash
* * * * * cd /path/to/laziznu-bjn && php artisan schedule:run >> /dev/null 2>&1
```

---

## Cara Restore Database

### Persiapan Restore

**PENTING**: Sebelum melakukan restore, pastikan:

1. ✅ Anda memiliki backup file yang valid
2. ✅ Database credentials sudah benar di `.env`
3. ✅ Database koneksi berfungsi dengan baik
4. ✅ Backup file belum corrupted
5. ✅ Cukup disk space untuk unzip backup

### Method 1: Manual Restore (Most Control)

#### Step 1: Locate Backup File

```bash
# Backup files tersimpan di:
ls -lah storage/app/private/Laravel/

# Output contoh:
# 2026-03-06-05-36-30.zip
# 2026-03-06-00-32-28.zip
```

#### Step 2: Extract Database Dump

```bash
# Pergi ke backup directory
cd storage/app/private/Laravel

# Extract backup zip (atau gunakan file manager)
unzip 2026-03-06-05-36-30.zip

# Cari file database dump (biasanya berformat database-*.sql.gz atau database-*.sql)
# Contoh: database-2026-03-06-05-36-30.sql.gz (compressed)
#         atau: database-2026-03-06-05-36-30.sql (uncompressed)

# Jika compressed, extract dulu
gunzip database-2026-03-06-05-36-30.sql.gz
# Hasilnya: database-2026-03-06-05-36-30.sql
```

#### Step 3: Create Fresh Database (Optional tapi Recommended)

```bash
# Login ke MySQL
mysql -u root -p

# Dalam MySQL CLI:
DROP DATABASE IF EXISTS db-laziznubjn;
CREATE DATABASE db-laziznubjn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

Atau gunakan command line:

```bash
# Drop existing database
mysql -u root -p -e "DROP DATABASE IF EXISTS db-laziznubjn;"

# Create fresh database
mysql -u root -p -e "CREATE DATABASE db-laziznubjn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

#### Step 4: Restore Database

```bash
# Restore dari SQL dump file
mysql -u root -p db-laziznubjn < database-2026-03-06-05-36-30.sql

# Atau jika file belum diekstrak:
gunzip -c database-2026-03-06-05-36-30.sql.gz | mysql -u root -p db-laziznubjn
```

Jika password ada:

```bash
mysql -u root -pYourPassword db-laziznubjn < database-2026-03-06-05-36-30.sql
```

#### Step 5: Verify Restore

```bash
# Cek apakah data restore berhasil
mysql -u root -p -e "USE db-laziznubjn; SHOW TABLES; SELECT COUNT(*) FROM users;"

# Clear Laravel cache
php artisan cache:clear

# Restart application
# (Jika menggunakan PHP built-in server)
```

#### Step 6: Restore Application Files (Optional)

Jika perlu restore seluruh aplikasi files dari backup:

```bash
# Extract full backup
cd /tmp
unzip /path/to/storage/app/private/Laravel/2026-03-06-05-36-30.zip

# Copy files (HATI-HATI dengan permissions)
# Lebih baik review files terlebih dahulu sebelum copy

# Atau extract hanya specific directories
cd /path/to/project
unzip -o /path/to/backup.zip "app/*" "resources/*" "routes/*"
```

### Method 2: Automatic Restore Using Package

Jika menginstall paket restore helper:

```bash
# (Saat ini belum ada built-in restore command, lakukan manual method)
```

---

## Lokasi Backup Files

### Direktori Utama

```
storage/app/private/Laravel/
├── 2026-03-06-05-36-30.zip    ← Complete backup (files + database)
├── 2026-03-05-05-34-22.zip
├── 2026-03-04-05-32-15.zip
└── ...
```

### Struktur File dalam Backup ZIP

```
backup.zip
├── database-2026-03-06-05-36-30.sql.gz    ← Database dump (compressed)
├── yourapp/                                 ← Full application files
│   ├── app/
│   ├── config/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── public/
│   └── ... (semua file aplikasi)
└── manifest.json                            ← Backup metadata
```

### Disk Configuration

```php
// config/filesystems.php
'local' => [
    'driver' => 'local',
    'root' => storage_path('app/private'),  // Backup disimpan di sini
    'serve' => true,
    'throw' => false,
]
```

---

## Troubleshooting

### Problem 1: Backup Gagal - "Insufficient Disk Space"

**Solution**:

```bash
# Cek disk space
df -h

# Cek size backup yang ada
du -sh storage/app/private/Laravel/

# Hapus backup old
php artisan backup:clean --verbose

# Atau manual delete
rm storage/app/private/Laravel/older-backup-file.zip
```

### Problem 2: Restore Error - "Access Denied"

**Solution**:

```bash
# Pastikan MySQL credentials benar di .env
cat .env | grep DB_

# Test MySQL connection
mysql -u root -pYourPassword -e "SHOW DATABASES;"

# Jika perlu reset password MySQL:
sudo mysql
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'newpassword';
mysql> FLUSH PRIVILEGES;
```

### Problem 3: Backup File Corrupted

**Solution**:

```bash
# Test zip integrity
unzip -t storage/app/private/Laravel/backup-file.zip

# Gunakan backup yang lebih lama
php artisan backup:list

# Jika semua corrupt, delete dan buat backup baru
```

### Problem 4: Database Restore Timeout

**Solution**:

```bash
# Increase MySQL max_allowed_packet (untuk file besar)
mysql -u root -p -e "SET GLOBAL max_allowed_packet=1073741824;"

# Atau edit my.cnf/mysqli.ini
[mysqld]
max_allowed_packet=1GB

# Restart MySQL
sudo systemctl restart mysql

# Copy database ke server dan restore:
mysql -u root -p db-laziznubjn < /tmp/database-dump.sql
```

### Problem 5: Notifikasi Email Tidak Terkirim

**Solution**:

```php
// Pastikan mail config benar di config/mail.php
// Test email:
php artisan tinker
Mail::raw('Test', function($message) {
    $message->to('your@email.com')->subject('Test');
});
exit

// Atau lihat log
tail -f storage/logs/laravel.log
```

---

## Monitoring Backup Health

```bash
# Cek backup status
php artisan backup:monitor

# Output akan menunjukkan:
# ✓ Backup name "Laravel" is healthy
# ✗ Backup disk has only 500MB free (max allowed: 10000MB)

# Check detail backups
php artisan backup:list
```

---

## Safety Checklist

- [ ] Backup configuration sudah dikonfigurasi di `config/backup.php`
- [ ] Cron job/Scheduler sudah aktif untuk automasi backup
- [ ] Email notification sudah dikonfigurasi (optional)
- [ ] Test backup sudah berjalan dengan sukses
- [ ] Test restore sudah dilakukan 1-2 kali
- [ ] Backup files sudah terverifikasi tidak corrupted
- [ ] Disk space monitor sudah aktif
- [ ] Backup retention policy sesuai kebutuhan
- [ ] Backup files sudah tersimpan di lokasi aman
- [ ] Database credentials sudah ter-secure di .env

---

## Environment Variables

```env
# .env configuration untuk backup

# Backup notification email
BACKUP_NOTIFICATION_EMAIL=admin@example.com

# Backup encryption (optional)
BACKUP_ENCRYPTION_ENABLED=false
BACKUP_ARCHIVE_PASSWORD=

# Jika menggunakan S3 storage (future)
# AWS_ACCESS_KEY_ID=
# AWS_SECRET_ACCESS_KEY=
# AWS_DEFAULT_REGION=
```

---

## Command Reference

```bash
# Backup Operations
php artisan backup:run              # Jalankan backup
php artisan backup:run --only-db    # Hanya database
php artisan backup:run --only-files # Hanya files
php artisan backup:run --verbose    # Dengan detail

# Maintenance
php artisan backup:clean            # Hapus old backups
php artisan backup:clean --verbose  # Dengan detail
php artisan backup:monitor          # Health check
php artisan backup:list             # List semua backup

# Umum
php artisan help backup:run         # Bantuan command
composer show spatie/laravel-backup # Cek versi package
```

---

## Referensi

- Package Documentation: https://spatie.be/docs/laravel-backup/v9
- Database Dumper: https://github.com/spatie/db-dumper
- Laravel Task Scheduling: https://laravel.com/docs/12/scheduling

---

**Last Updated**: March 6, 2026
**Package Version**: spatie/laravel-backup v9.3.6
**Laravel Version**: 12.51.0
**PHP Version**: 8.2.30
