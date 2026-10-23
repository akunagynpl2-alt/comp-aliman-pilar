<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhatsappNumber;
use App\Models\WhatsappTemplate;

class WhatsappSeeder extends Seeder
{
    public function run(): void
    {
        // Nomor WhatsApp
        $number = env('WHATSAPP_DEFAULT', '628119275730');
        if ($number && preg_match('/^62[0-9]{8,13}$/', $number)) {
            WhatsappNumber::query()->where('number', '!=', $number)->update(['is_active' => false]);
            WhatsappNumber::updateOrCreate(
                ['number' => $number],
                ['name' => 'Admin Penjualan', 'is_active' => true, 'sort_order' => 1]
            );
        } elseif (app()->environment('production')) {
            throw new \RuntimeException('WHATSAPP_DEFAULT wajib berisi nomor internasional yang valid sebelum menjalankan seeder di production.');
        }

        // Template pesan
        $templates = [
            [
                'key'      => 'product',
                'label'    => 'Pesan dari Halaman Produk',
                'template' => "Halo Aliman Pilar Production,\n\nSaya tertarik untuk menyewa *{product_name}*.\n\nMohon informasi ketersediaan dan penawaran terbaik untuk kebutuhan saya.\n\nTerima kasih 🙏",
            ],
            [
                'key'      => 'portfolio',
                'label'    => 'Pesan dari Halaman Portofolio',
                'template' => "Halo Aliman Pilar Production,\n\nSaya tertarik dengan layanan Anda setelah melihat portofolio *{event_title}* ({event_type} di {location}).\n\nSaya ingin mendiskusikan kebutuhan event saya. Mohon bantuannya 🙏",
            ],
            [
                'key'      => 'general',
                'label'    => 'Pesan Umum',
                'template' => "Halo Aliman Pilar Production,\n\nSaya ingin menanyakan informasi mengenai penyewaan perlengkapan event.\n\nMohon bantuannya. Terima kasih 🙏",
            ],
            [
                'key'      => 'contact',
                'label'    => 'Lanjut ke WhatsApp dari Form Kontak',
                'template' => "Halo Aliman Pilar Production,\n\nSaya *{name}* ingin berkonsultasi mengenai kebutuhan event:\n- Jenis Acara: {event_type}\n- Tanggal: {event_date}\n- Lokasi: {event_location}\n\nKebutuhan: {needs}\n\nMohon bantuannya 🙏",
            ],
        ];
        foreach ($templates as $t) {
            WhatsappTemplate::updateOrCreate(['key' => $t['key']], $t);
        }
    }
}
