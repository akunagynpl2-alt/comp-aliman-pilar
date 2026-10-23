<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use RuntimeException;

class ProductPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_slug' => 'lighting-pendingin',
                'name' => 'AC Standing 5 PK',
                'slug' => 'ac-standing-5-pk',
                'description' => 'Unit AC standing untuk membantu menjaga kenyamanan suhu di area acara. Penempatan dan kebutuhan daya dikonfirmasi berdasarkan kondisi venue.',
                'specifications' => 'Kebutuhan daya dan tata letak disesuaikan dengan lokasi acara.',
                'capacity' => '5 PK',
                'use_cases' => 'Pameran, ballroom, tenda, dan area acara indoor',
                'images' => ['ac-standing-5-pk-1.jpg', 'ac-standing-5-pk-2.jpg'],
            ],
            [
                'category_slug' => 'lighting-pendingin',
                'name' => 'Misty Fan',
                'slug' => 'misty-fan',
                'description' => 'Kipas dengan semprotan kabut air untuk membantu membuat area terbuka terasa lebih sejuk bagi pengunjung.',
                'specifications' => 'Penempatan unit disesuaikan dengan alur tamu dan kondisi area.',
                'capacity' => 'Jumlah unit mengikuti kebutuhan dan luas area',
                'use_cases' => 'Festival, bazaar, acara lapangan, dan area antre outdoor',
                'images' => ['misty-fan.jpg'],
            ],
            [
                'category_slug' => 'genset',
                'name' => 'Genset 40–300 KVA',
                'slug' => 'genset-40-300-kva',
                'description' => 'Pilihan genset untuk kebutuhan daya acara dengan skala beragam. Kapasitas dan konfigurasi distribusi listrik dibahas sesuai kebutuhan teknis venue.',
                'specifications' => 'Kapasitas tersedia dalam rentang 40–300 KVA.',
                'capacity' => 'Pilihan kapasitas 40–300 KVA',
                'use_cases' => 'Pameran, acara outdoor, panggung, dan kebutuhan daya venue',
                'images' => ['genset-40-300-kva-1.jpg', 'genset-40-300-kva-2.jpg'],
            ],
            [
                'category_slug' => 'tenda',
                'name' => 'Tenda Konvensional',
                'slug' => 'tenda-konvensional',
                'description' => 'Tenda untuk membantu menyediakan area teduh dan terlindungi di lokasi acara. Ukuran serta konfigurasi disesuaikan dengan kondisi venue.',
                'specifications' => 'Ukuran dan tata letak dikonfirmasi berdasarkan kebutuhan lokasi.',
                'capacity' => 'Konfigurasi mengikuti luas area acara',
                'use_cases' => 'Acara lingkungan, bazaar, kegiatan komunitas, dan area layanan',
                'images' => ['tenda-konvensional.jpg'],
            ],
            [
                'category_slug' => 'lighting-pendingin',
                'name' => 'AC Portable 1.5 PK',
                'slug' => 'ac-portable-1-5-pk',
                'description' => 'Unit AC portable untuk kebutuhan pendinginan area yang memerlukan solusi praktis. Penempatan dan jalur pembuangan udara dikonfirmasi sebelum acara.',
                'specifications' => 'Kebutuhan listrik dan jalur pembuangan disesuaikan dengan venue.',
                'capacity' => '1.5 PK',
                'use_cases' => 'Ruang sementara, booth, ruang VIP, dan area kerja acara',
                'images' => ['ac-portable-1-5-pk.jpg'],
            ],
            [
                'category_slug' => 'furniture',
                'name' => 'Meja IBM dan Kursi Futura',
                'slug' => 'meja-ibm-kursi-futura',
                'description' => 'Kombinasi meja IBM dan kursi Futura untuk kebutuhan registrasi, informasi, maupun area kerja selama acara.',
                'specifications' => 'Jumlah dan penataan unit disesuaikan dengan kebutuhan acara.',
                'capacity' => 'Konfigurasi meja dan kursi dapat disesuaikan',
                'use_cases' => 'Meja registrasi, ruang panitia, pameran, dan area layanan',
                'images' => ['meja-ibm-kursi-futura.jpg'],
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('slug', $data['category_slug'])->firstOrFail();
            $filenames = $data['images'];
            unset($data['category_slug'], $data['images']);
            $legacyFilenames = [
                'ac-standing-5-pk-1.jpg' => 'ac-5pk-standing-1.jpg',
                'ac-standing-5-pk-2.jpg' => 'ac-5pk-standing-2.jpg',
                'ac-portable-1-5-pk.jpg' => 'ac-portable-1-5pk.jpg',
            ];

            $product = Product::firstOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'category_id' => $category->id,
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 0,
                ])
            );
            $product->forceFill(['sort_order' => 0])->save();

            foreach ($filenames as $filename) {
                $legacyFilename = $legacyFilenames[$filename] ?? null;
                if ($legacyFilename) {
                    $product->getMedia('images')
                        ->first(fn ($media) => $media->getCustomProperty('source_file') === $legacyFilename)
                        ?->delete();
                }

                $path = __DIR__.'/assets/products/'.$filename;
                if (!is_file($path)) {
                    throw new RuntimeException("Foto produk tidak ditemukan: {$path}");
                }

                $alreadyAdded = $product->getMedia('images')->contains(
                    fn ($media) => $media->getCustomProperty('source_file') === $filename
                );

                if ($alreadyAdded) {
                    continue;
                }

                $product->addMedia($path)
                    ->preservingOriginal()
                    ->withCustomProperties([
                        'source_file' => $filename,
                        'source_url' => 'https://alimanpilar.com/',
                    ])
                    ->toMediaCollection('images');
            }
        }
    }
}
