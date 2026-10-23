<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tenda',                   'slug' => 'tenda',                  'description' => 'Berbagai jenis tenda event untuk segala cuaca dan skala acara — dari tenda VIP premium hingga tenda prasmanan.', 'icon' => 'tent',              'sort_order' => 1],
            ['name' => 'Flooring & Karpet',       'slug' => 'flooring-karpet',        'description' => 'Lantai dekoratif dan karpet event premium untuk tampilan yang rapi, nyaman, dan elegan.', 'icon' => 'floor',             'sort_order' => 2],
            ['name' => 'Toilet Portable',         'slug' => 'toilet-portable',        'description' => 'Toilet portable modern dan higienis untuk event outdoor dengan kapasitas besar.', 'icon' => 'toilet',            'sort_order' => 3],
            ['name' => 'Genset',                  'slug' => 'genset',                 'description' => 'Generator listrik handal untuk menjamin ketersediaan daya tanpa gangguan di setiap event.', 'icon' => 'generator',         'sort_order' => 4],
            ['name' => 'LED Screen',              'slug' => 'led-screen',             'description' => 'Layar LED indoor dan outdoor resolusi tinggi untuk presentasi, backdrop, dan hiburan visual.', 'icon' => 'screen',            'sort_order' => 5],
            ['name' => 'Smart TV',                'slug' => 'smart-tv',               'description' => 'Smart TV berbagai ukuran untuk display informasi, hiburan, dan dekorasi event.', 'icon' => 'tv',                'sort_order' => 6],
            ['name' => 'Sound System',            'slug' => 'sound-system',           'description' => 'Sistem audio profesional dari speaker line array hingga mixer digital untuk konser dan event besar.', 'icon' => 'sound',             'sort_order' => 7],
            ['name' => 'Lighting & Pendingin',    'slug' => 'lighting-pendingin',     'description' => 'Sistem pencahayaan kreatif dan peralatan pendingin untuk kenyamanan maksimal tamu.', 'icon' => 'lighting',          'sort_order' => 8],
            ['name' => 'Stage & Backdrop',        'slug' => 'stage-backdrop',         'description' => 'Panggung modular dan backdrop profesional yang dapat disesuaikan dengan tema dan skala event.', 'icon' => 'stage',             'sort_order' => 9],
            ['name' => 'Furniture',               'slug' => 'furniture',              'description' => 'Furnitur event premium — meja, kursi, sofa, dan dekorasi untuk interior event yang memukau.', 'icon' => 'furniture',         'sort_order' => 10],
            ['name' => 'Partisi',                 'slug' => 'partisi',                'description' => 'Sistem partisi modular untuk pembatas ruang, booth pameran, dan dekorasi interior.', 'icon' => 'partition',         'sort_order' => 11],
            ['name' => 'Perangkat Komunikasi',    'slug' => 'perangkat-komunikasi',   'description' => 'Walkie-talkie, headset, dan sistem komunikasi untuk koordinasi tim event yang lancar.', 'icon' => 'communication',     'sort_order' => 12],
            ['name' => 'Produksi & Branding',     'slug' => 'produksi-branding',      'description' => 'Peralatan produksi event dan material branding — dari spanduk, signage, hingga x-banner.', 'icon' => 'branding',          'sort_order' => 13],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], array_merge($cat, ['is_active' => true]));
        }
    }
}
