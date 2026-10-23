<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'superadmin')->first();

        $categories = [
            ['name' => 'Tips Event', 'slug' => 'tips-event'],
            ['name' => 'Panduan Sewa',   'slug' => 'panduan-sewa'],
            ['name' => 'Inspirasi Acara','slug' => 'inspirasi-acara'],
            ['name' => 'Info Produk',    'slug' => 'info-produk'],
        ];
        foreach ($categories as $cat) {
            BlogCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        if (! $admin) {
            $this->command?->warn('Artikel contoh dilewati karena belum ada admin. Atur ADMIN_EMAIL dan ADMIN_PASSWORD, jalankan seeder admin, lalu ulangi seeding blog.');

            return;
        }

        $tipsCategory = BlogCategory::where('slug', 'tips-event')->first();
        $panduanCategory = BlogCategory::where('slug', 'panduan-sewa')->first();

        $posts = [
            [
                'user_id'          => $admin->id,
                'blog_category_id' => $tipsCategory->id,
                'title'            => '[CONTOH] 7 Tips Memilih Tenda Event untuk Acara Outdoor',
                'slug'             => '7-tips-memilih-tenda-event-outdoor',
                'excerpt'          => 'Memilih tenda event bukan sekadar soal ukuran. Ada 7 faktor krusial yang menentukan kesuksesan acara outdoor Anda — dari material hingga sistem pengangkuran.',
                'content'          => '<h2>Mengapa Pemilihan Tenda Sangat Krusial?</h2><p>Tenda adalah fondasi fisik dari setiap event outdoor. Pilihan yang tepat memastikan tamu Anda nyaman, peralatan terlindungi, dan acara berlangsung tanpa hambatan cuaca.</p><h2>1. Sesuaikan Material dengan Kondisi Cuaca</h2><p>Indonesia memiliki dua musim utama. Untuk musim hujan, pilih tenda dengan material PVC minimum 500 gr/m² yang kedap air. Untuk musim kering, pastikan tenda memiliki ventilasi yang baik untuk sirkulasi udara.</p><h2>2. Hitung Kapasitas dengan Formula yang Tepat</h2><p>Aturan umum: untuk standing party, alokasikan 0.5 m² per orang. Untuk seated dinner, 1.5-2 m² per orang. Jangan lupa tambah 20% untuk area sirkulasi, panggung, dan prasmanan.</p><h2>3. Periksa Sistem Pengangkuran</h2><p>Di tanah keras atau area paving, pastikan tenda dapat dipasang dengan sandbag atau sistem angkur alternatif. Jangan abaikan ini — ini soal keselamatan tamu Anda.</p><h2>4. Pertimbangkan Aksesibilitas Vendor Lain</h2><p>Pastikan tenda memiliki pintu dan akses yang cukup untuk masuk-keluarnya peralatan katering, dekorasi, dan sound system.</p><h2>5. Rencanakan Sistem Pencahayaan di Awal</h2><p>Tenda yang baik harus memiliki titik rigging untuk lampu. Diskusikan kebutuhan lighting sebelum memesan tenda agar instalasi berjalan lancar.</p><h2>6. Evaluasi Sistem Pendingin</h2><p>Tenda tanpa ventilasi bisa sangat panas. Pertimbangkan tenda dengan bukaan samping, kipas industri, atau AC portable sesuai anggaran.</p><h2>7. Minta Survei Lokasi Terlebih Dahulu</h2><p>Sebelum memesan, undang vendor untuk survei lokasi. Faktor seperti kemiringan tanah, pohon di sekitar, dan kondisi akses sangat mempengaruhi pilihan tenda yang tepat.</p><p><strong>Butuh konsultasi lebih lanjut?</strong> Tim kami siap membantu Anda memilih tenda yang paling sesuai untuk event Anda.</p>',
                'is_featured'      => true,
                'is_published'     => true,
                'published_at'     => now()->subDays(10),
                'meta_title'       => '7 Tips Memilih Tenda Event untuk Acara Outdoor | Aliman Pilar Production',
                'meta_description' => 'Panduan lengkap memilih tenda event yang tepat. 7 faktor penting: material, kapasitas, pengangkuran, pencahayaan, dan tips dari ahlinya.',
                'focus_keyword'    => 'tips memilih tenda event outdoor',
            ],
            [
                'user_id'          => $admin->id,
                'blog_category_id' => $panduanCategory->id,
                'title'            => '[CONTOH] Panduan Menghitung Kebutuhan Genset untuk Event',
                'slug'             => 'panduan-sewa-genset-event-hitung-kebutuhan-daya',
                'excerpt'          => 'Kehabisan daya di tengah acara adalah bencana. Pelajari cara menghitung kebutuhan daya genset yang tepat untuk event Anda agar tidak terjadi hal yang tidak diinginkan.',
                'content'          => '<h2>Mengapa Perencanaan Daya Itu Penting?</h2><p>Kerusakan daya listrik di tengah acara dapat merusak seluruh pengalaman tamu dan reputasi event Anda. Perencanaan yang tepat adalah kunci.</p><h2>Cara Menghitung Kebutuhan Daya</h2><p>Langkah pertama: buat daftar semua peralatan yang akan digunakan beserta konsumsi daya (watt) masing-masing. Kemudian jumlahkan total, dan tambahkan safety margin 25-30%.</p><h3>Contoh Perhitungan untuk Wedding 500 Pax:</h3><ul><li>Sound System Line Array: 6.000 Watt</li><li>Lighting System: 8.000 Watt</li><li>LED Screen 6×3 m: 3.000 Watt</li><li>Katering (kompor gas listrik, dll.): 4.000 Watt</li><li>AC Portable 4 unit: 8.800 Watt</li><li>Lain-lain: 2.000 Watt</li></ul><p><strong>Total: 31.800 Watt + 25% safety = ~40.000 Watt = 50 KVA</strong></p><h2>Tips Memilih Genset yang Tepat</h2><p>Pilih kapasitas genset yang 20-30% lebih besar dari kebutuhan aktual. Genset yang bekerja pada beban 70-80% kapasitas akan lebih efisien dan lebih awet.</p>',
                'is_featured'      => false,
                'is_published'     => true,
                'published_at'     => now()->subDays(5),
                'meta_title'       => 'Panduan Sewa Genset untuk Event: Cara Hitung Kebutuhan Daya | Aliman Pilar Production',
                'meta_description' => 'Pelajari cara menghitung kebutuhan daya genset untuk event Anda. Panduan lengkap dari pakar event equipment rental.',
                'focus_keyword'    => 'sewa genset untuk event',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
