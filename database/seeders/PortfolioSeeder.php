<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'title'          => '[CONTOH] Wedding Ballroom — isi nama acara sebenarnya',
                'slug'           => 'grand-wedding-siti-budi-sheraton-jakarta',
                'client'         => '[CONTOH KLIEN] Ganti dengan nama dan izin publikasi',
                'event_type'     => 'Wedding',
                'location'       => '[CONTOH LOKASI] Isi venue dan kota sebenarnya',
                'event_date'     => '2024-09-15',
                'description'    => '[KONTEN CONTOH — GANTI] Contoh ringkasan kebutuhan wedding dan perlengkapan yang digunakan.',
                'content'        => 'PLACEHOLDER PORTOFOLIO — Ganti dengan dokumentasi proyek, data yang benar, dan izin publikasi klien.',
                'equipment_used' => ['LED Screen Indoor P3 8×3 m', 'Line Array 10.000 Watt', 'Lighting Package Concert', 'Set Meja Bundar + Kursi Chiavari (120 set)', 'Parket Vinyl White Rose'],
                'is_featured'    => true,
                'sort_order'     => 1,
            ],
            [
                'title'          => '[CONTOH] Pameran industri — isi nama acara sebenarnya',
                'slug'           => 'pameran-industri-nasional-2024-jcc',
                'client'         => '[CONTOH KLIEN] Ganti dengan nama dan izin publikasi',
                'event_type'     => 'Pameran',
                'location'       => '[CONTOH LOKASI] Isi venue dan kota sebenarnya',
                'event_date'     => '2024-07-20',
                'description'    => '[KONTEN CONTOH — GANTI] Ringkasan ini hanya contoh susunan layanan untuk pameran.',
                'content'        => 'PLACEHOLDER PORTOFOLIO — Ganti dengan dokumentasi proyek, data yang benar, dan izin publikasi klien.',
                'equipment_used' => ['Partisi Octanorm 500+ panel', 'Flooring Vinyl 2000 m²', 'LED Screen P3 (8 unit)', 'Genset Silent 250 KVA (2 unit)', 'AC Portable 2 PK (20 unit)'],
                'is_featured'    => true,
                'sort_order'     => 2,
            ],
            [
                'title'          => '[CONTOH] Festival outdoor — isi nama acara sebenarnya',
                'slug'           => 'festival-musik-indie-soundscape-2024-malang',
                'client'         => '[CONTOH KLIEN] Ganti dengan nama dan izin publikasi',
                'event_type'     => 'Festival',
                'location'       => '[CONTOH LOKASI] Isi venue dan kota sebenarnya',
                'event_date'     => '2024-05-11',
                'description'    => '[KONTEN CONTOH — GANTI] Contoh kebutuhan peralatan untuk festival outdoor.',
                'content'        => 'PLACEHOLDER PORTOFOLIO — Ganti dengan dokumentasi proyek, data yang benar, dan izin publikasi klien.',
                'equipment_used' => ['Panggung Modular 12×8 m', 'LED Screen Outdoor P6 10×6 m', 'Sound System Line Array 50.000 Watt', 'Genset Silent 250 KVA (3 unit)', 'Tenda Sarnafil VIP 10×20 m (Area VIP)'],
                'is_featured'    => true,
                'sort_order'     => 3,
            ],
            [
                'title'          => '[CONTOH] Corporate gathering — isi nama acara sebenarnya',
                'slug'           => 'corporate-annual-gathering-pt-energi-nusantara',
                'client'         => '[CONTOH KLIEN] Ganti dengan nama dan izin publikasi',
                'event_type'     => 'Corporate Event',
                'location'       => '[CONTOH LOKASI] Isi venue dan kota sebenarnya',
                'event_date'     => '2024-03-08',
                'description'    => '[KONTEN CONTOH — GANTI] Ringkasan contoh untuk kebutuhan corporate gathering.',
                'content'        => 'PLACEHOLDER PORTOFOLIO — Ganti dengan dokumentasi proyek, data yang benar, dan izin publikasi klien.',
                'equipment_used' => ['Panggung Modular 10×6 m', 'LED Screen Indoor P3 6×3 m', 'Lighting Package Concert', 'Sound System Line Array 10.000 Watt', 'Set Meja + Kursi Chiavari (80 set)'],
                'is_featured'    => false,
                'sort_order'     => 4,
            ],
        ];

        foreach ($portfolios as $p) {
            Portfolio::updateOrCreate(['slug' => $p['slug']], array_merge($p, ['is_active' => true]));
        }
    }
}
