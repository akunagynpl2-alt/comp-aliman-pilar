<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $address = 'Jalan Serut No.78 Pondok Ranggon, Cipayung Jakarta Timur';
        $settings = [
            // General
            ['key' => 'site_name',          'value' => 'Aliman Pilar Production',          'group' => 'general', 'type' => 'text',    'label' => 'Nama Situs'],
            ['key' => 'site_tagline',        'value' => 'Pilar Penopang Acara Anda',        'group' => 'general', 'type' => 'text',    'label' => 'Tagline'],
            ['key' => 'site_description',    'value' => 'Solusi sewa perlengkapan event terlengkap untuk wedding, corporate, konser, dan festival. Peralatan premium, tim profesional, antar-jemput dan pemasangan.', 'group' => 'general', 'type' => 'textarea', 'label' => 'Deskripsi Situs'],
            ['key' => 'site_keywords',       'value' => 'sewa tenda event, sewa genset, sewa LED screen, sewa sound system, sewa perlengkapan wedding, sewa stage, sewa lighting', 'group' => 'general', 'type' => 'text', 'label' => 'Keywords SEO'],
            ['key' => 'google_maps_embed',   'value' => 'https://www.google.com/maps?q='.urlencode($address).'&output=embed', 'group' => 'general', 'type' => 'textarea','label' => 'Google Maps Embed URL'],
            ['key' => 'google_analytics_id', 'value' => '',                                 'group' => 'general', 'type' => 'text',    'label' => 'Google Analytics ID'],

            // Contact
            ['key' => 'address',             'value' => $address,                                'group' => 'contact', 'type' => 'textarea', 'label' => 'Alamat Kantor'],
            ['key' => 'email',               'value' => '',                                      'group' => 'contact', 'type' => 'text',    'label' => 'Email Utama'],
            ['key' => 'email_secondary',     'value' => '',                                      'group' => 'contact', 'type' => 'text',    'label' => 'Email Penjualan'],
            ['key' => 'phone_main',          'value' => '628119275730',                          'group' => 'contact', 'type' => 'text',    'label' => 'Telepon Utama'],
            ['key' => 'operating_hours',     'value' => 'Isi jam operasional resmi perusahaan',   'group' => 'contact', 'type' => 'textarea', 'label' => 'Jam Operasional (ganti sebelum publikasi)'],
            ['key' => 'instagram',           'value' => '',                                      'group' => 'contact', 'type' => 'text',    'label' => 'Instagram resmi'],
            ['key' => 'facebook',            'value' => '',                                 'group' => 'contact', 'type' => 'text',    'label' => 'Facebook'],
            ['key' => 'youtube',             'value' => '',                                 'group' => 'contact', 'type' => 'text',    'label' => 'YouTube'],

            // Stats
            ['key' => 'stat_events',         'value' => 'Isi data terverifikasi',            'group' => 'stats',   'type' => 'text',    'label' => 'Jumlah Event (ganti sebelum publikasi)'],
            ['key' => 'stat_years',          'value' => 'Isi data terverifikasi',            'group' => 'stats',   'type' => 'text',    'label' => 'Tahun Pengalaman (ganti sebelum publikasi)'],
            ['key' => 'stat_clients',        'value' => 'Isi data terverifikasi',            'group' => 'stats',   'type' => 'text',    'label' => 'Klien (ganti sebelum publikasi)'],
            ['key' => 'stat_products',       'value' => 'Isi data terverifikasi',            'group' => 'stats',   'type' => 'text',    'label' => 'Unit Peralatan (ganti sebelum publikasi)'],

            // Service areas
            ['key' => 'service_areas',       'value' => 'Isi kota dan wilayah layanan resmi', 'group' => 'general', 'type' => 'text', 'label' => 'Area Layanan (ganti sebelum publikasi)'],

            // Hero
            ['key' => 'hero_headline',       'value' => 'Fondasi kuat untuk acara besar.',   'group' => 'hero', 'type' => 'textarea', 'label' => 'Hero Headline'],
            ['key' => 'hero_subheadline',    'value' => 'Kami adalah pilar penopang acara Anda dengan peralatan siap dan dukungan teknis.', 'group' => 'hero', 'type' => 'textarea', 'label' => 'Hero Subheadline'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
            Cache::forget('site_setting:'.$setting['key']);
        }
    }
}
