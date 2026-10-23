<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name'  => '[CONTOH] Nama klien',
                'client_title' => 'Placeholder — ganti dengan identitas berizin',
                'event_type'   => 'Wedding',
                'content'      => 'PLACEHOLDER TESTIMONI — Ganti dengan kutipan asli yang sudah mendapat izin publikasi dari klien.',
                'rating'       => 5,
                'is_featured'  => true,
                'sort_order'   => 1,
            ],
            [
                'client_name'  => '[CONTOH] Nama klien',
                'client_title' => 'Placeholder — ganti dengan identitas berizin',
                'event_type'   => 'Corporate Event',
                'content'      => 'PLACEHOLDER TESTIMONI — Ganti dengan kutipan asli yang sudah mendapat izin publikasi dari klien.',
                'rating'       => 5,
                'is_featured'  => true,
                'sort_order'   => 2,
            ],
            [
                'client_name'  => '[CONTOH] Nama klien',
                'client_title' => 'Placeholder — ganti dengan identitas berizin',
                'event_type'   => 'Festival',
                'content'      => 'PLACEHOLDER TESTIMONI — Ganti dengan kutipan asli yang sudah mendapat izin publikasi dari klien.',
                'rating'       => 5,
                'is_featured'  => true,
                'sort_order'   => 3,
            ],
            [
                'client_name'  => '[CONTOH] Nama klien',
                'client_title' => 'Placeholder — ganti dengan identitas berizin',
                'event_type'   => 'Wedding',
                'content'      => 'PLACEHOLDER TESTIMONI — Ganti dengan kutipan asli yang sudah mendapat izin publikasi dari klien.',
                'rating'       => 5,
                'is_featured'  => false,
                'sort_order'   => 4,
            ],
            [
                'client_name'  => '[CONTOH] Nama klien',
                'client_title' => 'Placeholder — ganti dengan identitas berizin',
                'event_type'   => 'Turnamen',
                'content'      => 'PLACEHOLDER TESTIMONI — Ganti dengan kutipan asli yang sudah mendapat izin publikasi dari klien.',
                'rating'       => 5,
                'is_featured'  => false,
                'sort_order'   => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['client_name' => $t['client_name'].' '.$t['sort_order']],
                array_merge($t, ['is_active' => true])
            );
        }
    }
}
