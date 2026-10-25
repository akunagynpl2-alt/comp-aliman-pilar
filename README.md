# Aliman Pilar Production

Website company profile dan katalog perlengkapan event berbasis Laravel 12, Blade, Tailwind CSS 4, Alpine.js, dan MySQL. Pengunjung melihat katalog lalu menghubungi tim melalui WhatsApp; website tidak menyediakan harga, checkout, atau pembayaran.

## Kebutuhan

- PHP 8.2+ dengan ekstensi Laravel yang umum dipakai, termasuk `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd`, `exif`, dan `xml`.
- Composer 2, Node.js 20+, npm, serta MySQL 8+ atau MariaDB yang kompatibel.

## Instalasi lokal (PowerShell)

```powershell
git clone <URL-REPOSITORY>
cd project_kunang
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Edit `.env`: pilih koneksi database lokal, `APP_URL`, dan isi `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PHONE`, serta `ADMIN_PASSWORD` (minimal 12 karakter). Atur nilai `WHATSAPP_DEFAULT` dan sesuaikan juga nomor kontak dari panel admin. Jangan gunakan kredensial atau nomor contoh di lingkungan publik.

```powershell
npm install
npm run build
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

Buka `http://127.0.0.1:8000`. Masuk melalui `/admin/login` menggunakan email dan sandi yang sudah diatur di `.env`. Akun admin hanya dibuat saat seeder dijalankan dengan variabel admin terisi. Untuk pengembangan frontend, jalankan `npm run dev` di terminal terpisah.

Untuk pengujian, jalankan `php artisan test`. Database pengujian menggunakan SQLite in-memory.

## Deployment

### Railway

1. Buat project Railway tersendiri untuk aplikasi dan service database MySQL; jangan gunakan project milik aplikasi lain.
2. Hubungkan service aplikasi ke repository ini. `railway.json` mengatur build aset, migrasi otomatis sebelum deploy, dan health check `/up`; Railway Railpack mendeteksi runtime Laravel.
3. Atur variabel `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY`, `APP_URL`, `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, dan `LOG_CHANNEL=stderr`. Referensikan kredensial privat dari service MySQL Railway.
4. Pasang volume persisten pada `storage/app/public` sebelum menerima upload produk, lalu jalankan `php artisan storage:link`.
5. Isi kredensial admin awal dan `WHATSAPP_DEFAULT` sebagai variable Railway sebelum menjalankan seeder pertama. Jangan menaruh rahasia pada source code.
6. Build aset dapat dilakukan sebagai bagian dari build service:

   ```sh
   npm ci
   npm run build
   ```

7. Railway Railpack menangani server web dan port publik; jangan menjalankan server development `artisan serve` sebagai server produksi.
8. Untuk pemasangan pertama, jalankan seeder setelah variable admin tersedia. Verifikasi halaman publik, `/admin/login`, sitemap, HTTPS, formulir kontak, dan tautan WhatsApp.

### Vercel (runtime PHP komunitas)

Vercel tidak menyediakan runtime Laravel/PHP resmi. Konfigurasi project ini menggunakan `vercel-php` dari komunitas Vercel. Runtime tersebut tidak menyediakan ekstensi GD, sehingga konversi gambar dinonaktifkan di deployment Vercel; gambar asli tetap dapat diunggah dan disimpan pada object storage S3-compatible.

1. Buat **project Vercel baru** pada workspace yang dipilih dan impor repository `akunagynpl2-alt/comp-aliman-pilar` dari branch `main`. Tetapkan Root Directory ke direktori aplikasi (root repository); jangan menghubungkan deployment ke project Kaizen yang sudah ada.
2. Siapkan database MySQL eksternal yang dapat diakses dari Vercel dan bucket S3-compatible dengan URL publik untuk gambar. Vercel filesystem lokal bersifat sementara; jangan gunakan untuk sesi atau gambar upload.
3. Tambahkan Environment Variables berikut pada project Vercel. Masukkan rahasia hanya melalui dashboard/CLI Vercel, bukan ke repository atau chat:
   - Laravel: `APP_KEY`, `APP_URL`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.
   - S3-compatible storage: `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`, `AWS_URL`; untuk provider selain AWS, isi juga `AWS_ENDPOINT` dan atur `AWS_USE_PATH_STYLE_ENDPOINT` sesuai provider.
   - Untuk membuat admin pertama kali, isi `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PHONE`, dan `ADMIN_PASSWORD` saat menjalankan seeder. Hapus nilai sandi dari environment setelah admin dibuat.
4. `vercel.json` mengatur routing PHP, asset statis, sesi/cache berbasis database, log ke stderr, direktori sementara di `/tmp`, disk media S3, dan konversi gambar yang dinonaktifkan. Build command Composer menjalankan `npm ci` dan `npm run build`.
5. Setelah environment variables tersedia, jalankan migrasi dan seeder satu kali dengan koneksi ke database production (`php artisan migrate --force` dan `php artisan db:seed --force`). Pastikan bucket dapat menerima unggahan sebelum seeding foto produk.
6. Deploy dan verifikasi halaman publik, login admin, upload foto asli, formulir kontak, sitemap, dan tautan WhatsApp.

### Shared hosting cPanel

1. Pilih hosting dengan PHP 8.2+, ekstensi yang diperlukan, Composer, akses SSH/Terminal, MySQL, dan document root domain/subdomain yang dapat diarahkan ke folder `public` Laravel.
2. Unggah source aplikasi **di luar** `public_html` bila memungkinkan. Arahkan document root domain ke folder `project/public`; jangan membuat folder aplikasi, `.env`, `vendor`, atau source privat dapat diakses publik.
3. Buat database dan user MySQL di cPanel. Salin `.env.example` menjadi `.env`, lalu isi `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, `APP_KEY`, koneksi database, kredensial admin awal, serta nomor WhatsApp. Batasi izin file `.env`.
4. Melalui Terminal pada folder aplikasi, jalankan:

   ```sh
   composer install --no-dev --optimize-autoloader
   npm ci
   npm run build
   php artisan migrate --force
   php artisan db:seed --force
   php artisan storage:link
   php artisan optimize
   ```

   Build frontend dapat dilakukan di komputer/CI bila Node.js tidak tersedia di hosting, lalu unggah folder `public/build`.
5. Pastikan `storage` dan `bootstrap/cache` dapat ditulis oleh proses PHP, aktifkan HTTPS, dan siapkan backup database serta file upload.
6. Setelah deploy, isi seluruh placeholder dari admin dan uji form kontak, pengiriman gambar, login admin, peta, sitemap, dan WhatsApp.

Jika provider tidak mengizinkan document root ke `public/`, minta provider mengatur document root dengan benar. Hindari memindahkan seluruh source Laravel ke `public_html` atau mengekspos file konfigurasi.

## Panel admin

- URL masuk: `/admin/login`.
- Akun awal dibuat dari `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PHONE`, dan `ADMIN_PASSWORD` di `.env` saat `php artisan db:seed`.
- Konten yang dikelola: kategori, produk tanpa harga, portofolio, artikel dan kategori artikel, testimoni, klien/mitra, pesan kontak, pengaturan situs, nomor/template WhatsApp, dan profil admin.
- Unggah gambar dioptimasi melalui konfigurasi media library. Simpan file upload pada storage yang persisten di server produksi.

## Struktur utama

```text
app/Http/Controllers/       Controller halaman publik dan admin
app/Http/Middleware/        Middleware autentikasi admin dan data global
app/Models/                 Model domain dan relasi
app/Providers/              Penyedia layanan dan limiter
database/migrations/        Skema database
database/seeders/           Konten contoh dan akun admin awal
resources/css/              Tema Tailwind dan komponen CSS
resources/js/               Interaksi frontend
resources/views/            Layout, komponen, halaman publik, dan admin
routes/                     Rute web dan admin
public/images/              Logo dan placeholder visual
tests/Feature/              Pengujian alur publik dan admin
```

## Placeholder yang harus diganti sebelum go-live

- Nomor WhatsApp `628119275730` dan alamat `Jalan Serut No.78 Pondok Ranggon, Cipayung Jakarta Timur` telah diatur; pastikan kembali kebenarannya dan tautan pin Google Maps sebelum publikasi.
- Email, telepon alternatif, jam operasional, area layanan, URL media sosial, serta identitas Analytics bila digunakan.
- Statistik, nama/logo klien, testimoni, portofolio, lokasi/tanggal event, gambar produk, gambar artikel, dan informasi tim. Hapus klaim contoh yang belum diverifikasi.
- Seluruh konten kategori/produk dan kebijakan privasi/syarat layanan agar sesuai operasional serta kebijakan perusahaan.
- Domain dan konfigurasi SEO, metadata sosial, favicon/logo final, SMTP, backup, penyimpanan upload, dan kredensial admin produksi.

Semua konten seeder adalah data contoh, bukan klaim pencapaian nyata. Jangan memasukkan nominal harga pada konten website.

## Checklist sebelum go-live

- [ ] `APP_DEBUG=false`, `APP_ENV=production`, `APP_KEY` unik, HTTPS aktif, dan rahasia tidak masuk repository.
- [ ] Migrasi serta seeder awal selesai; sandi admin kuat dan diganti setelah provisioning bila diperlukan.
- [ ] Placeholder, data klaim, nomor WhatsApp, template pesan, alamat dan jam operasional sudah diverifikasi.
- [ ] `npm run build` berhasil; `public/build/manifest.json` tersedia.
- [ ] `php artisan test` lulus dan `php artisan storage:link` tersedia untuk filesystem lokal.
- [ ] Upload dibatasi, storage persisten dan writable; backup database/media diuji.
- [ ] Halaman produk, detail produk, formulir kontak, admin, sitemap, robots, mobile, dan pilihan WhatsApp diuji.
- [ ] Email, peta, metadata sosial, kebijakan, serta aksesibilitas dasar sudah ditinjau.
