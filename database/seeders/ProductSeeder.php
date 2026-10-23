<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // TENDA
            [
                'category_slug' => 'tenda',
                'name'          => 'Tenda Sarnafil VIP Premium',
                'slug'          => 'tenda-sarnafil-vip-premium',
                'description'   => 'Hadirkan kesan mewah pada event outdoor Anda dengan Tenda Sarnafil VIP Premium. Material PVC berkualitas tinggi dengan lapisan anti-UV menjamin ketahanan terhadap terik matahari dan hujan deras. Struktur baja galvanis yang kokoh memastikan keamanan ribuan tamu sekaligus.',
                'specifications'=> "Material: PVC Sarnafil 650 gr/m²\nStruktur: Baja Galvanis\nWarna: Putih Ivory / Biru / Custom\nTinggi Sisi: 2.5 m\nTinggi Puncak: 4.5 m\nAnkur: Patok Beton / Sandbag",
                'capacity'      => 'Tersedia ukuran 5×5 m, 10×10 m, 10×20 m, 10×30 m, dan custom',
                'use_cases'     => 'Wedding outdoor, corporate gathering, pameran, festival musik, wisuda massal',
                'is_featured'   => true,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'tenda',
                'name'          => 'Tenda Kerucut Glamping',
                'slug'          => 'tenda-kerucut-glamping',
                'description'   => 'Ciptakan atmosfer bohemian yang instagramable dengan Tenda Kerucut Glamping kami. Desain unik berbentuk tipi memberikan sentuhan estetika berbeda pada wedding outdoor, intimate gathering, dan photobooth area.',
                'specifications'=> "Diameter: 5 m / 7 m\nTinggi: 4 m / 5.5 m\nMaterial: Canvas Tebal Anti-Hujan\nBisa Dilengkapi: Lampu Edison, Karpet, Bantal",
                'capacity'      => 'Diameter 5 m (20-30 tamu), Diameter 7 m (40-60 tamu)',
                'use_cases'     => 'Wedding intimate, birthday party, photobooth area, lounge VIP',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'tenda',
                'name'          => 'Tenda Prasmanan / Canopy',
                'slug'          => 'tenda-prasmanan-canopy',
                'description'   => 'Solusi praktis dan ekonomis untuk area prasmanan, parkir, dan area tunggu. Tenda canopy lipat yang mudah dipasang namun tetap sturdy menghadapi angin dan hujan ringan.',
                'specifications'=> "Ukuran: 3×3 m / 3×4.5 m / 3×6 m\nMaterial: Polyester 600D + Rangka Besi\nWarna: Putih, Merah, Biru, Hijau\nBisa Dilengkapi: Dinding samping",
                'capacity'      => 'Ukuran 3×3 m per unit, dapat disusun/disambung',
                'use_cases'     => 'Prasmanan, parkir VIP, pos keamanan, area registrasi, bazaar',
                'is_featured'   => false,
                'sort_order'    => 3,
            ],

            // GENSET
            [
                'category_slug' => 'genset',
                'name'          => 'Genset Silent 100 KVA',
                'slug'          => 'genset-silent-100-kva',
                'description'   => 'Jamin kelangsungan acara Anda dengan Genset Silent 100 KVA — sumber daya andalan untuk event skala menengah hingga besar. Teknologi silent box meredam suara mesin hingga di bawah 70 dB, sehingga tidak mengganggu jalannya acara.',
                'specifications'=> "Daya: 100 KVA (80 kW)\nMerk: Perkins / Cummins\nBahan Bakar: Solar\nKebisingan: ≤ 70 dB (7 m)\nAVR: Digital\nFrekuensi: 50 Hz\nInklusif: Panel, Kabel 50 m",
                'capacity'      => '100 KVA — cocok untuk event 500-1000 pax dengan kebutuhan audio-lighting penuh',
                'use_cases'     => 'Konser, wedding outdoor, corporate gala dinner, pameran besar',
                'is_featured'   => true,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'genset',
                'name'          => 'Genset Silent 250 KVA',
                'slug'          => 'genset-silent-250-kva',
                'description'   => 'Untuk event skala besar dengan kebutuhan daya tinggi, Genset Silent 250 KVA hadir sebagai solusi terpercaya. Dilengkapi sistem AVR digital untuk menstabilkan tegangan dan melindungi peralatan elektronik sensitif.',
                'specifications'=> "Daya: 250 KVA (200 kW)\nMerk: Cummins / Stamford\nBahan Bakar: Solar\nKebisingan: ≤ 75 dB (7 m)\nAVR: Digital Automatic\nCapacity Tank: 400 Liter",
                'capacity'      => '250 KVA — untuk event 2000+ pax, konser, festival',
                'use_cases'     => 'Festival musik, pameran nasional, turnamen olahraga besar',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],

            // LED SCREEN
            [
                'category_slug' => 'led-screen',
                'name'          => 'LED Screen Indoor P3 Full Color',
                'slug'          => 'led-screen-indoor-p3-full-color',
                'description'   => 'Tampilkan presentasi, video company profile, dan konten promosi dalam kualitas visual yang memukau. LED Screen Indoor P3 menghadirkan warna yang hidup dan tajam bahkan dari jarak dekat — sempurna untuk aula, ballroom, dan ruang konvensi.',
                'specifications'=> "Pitch: P3 mm\nBrightness: 1200 nits\nRefresh Rate: 3840 Hz\nResolution: Custom (per modul 192×192 mm)\nKoneksi: HDMI, DVI, VGA, LAN\nModular: Ya (dapat disusun bebas)",
                'capacity'      => 'Ukuran custom mulai dari 2×1 m hingga 8×4 m dan lebih',
                'use_cases'     => 'Seminar, konferensi, wedding reception, gala dinner, pameran indoor',
                'is_featured'   => true,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'led-screen',
                'name'          => 'LED Screen Outdoor P6 Weatherproof',
                'slug'          => 'led-screen-outdoor-p6-weatherproof',
                'description'   => 'Hadirkan visual spektakuler di area outdoor dengan LED Screen P6 berproteksi IP65. Kecerahan 5000+ nits memastikan tampilan tetap terang dan jelas bahkan di bawah sinar matahari langsung.',
                'specifications'=> "Pitch: P6 mm\nBrightness: 5000+ nits\nIP Rating: IP65\nRefresh Rate: 1920 Hz\nStruktur: Truss/Ground Support\nKoneksi: HDMI, LAN (Novastar)",
                'capacity'      => 'Modular mulai 3×2 m hingga 12×6 m (custom)',
                'use_cases'     => 'Konser outdoor, festival, turnamen olahraga, kampanye, pameran outdoor',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],

            // SOUND SYSTEM
            [
                'category_slug' => 'sound-system',
                'name'          => 'Line Array System 10.000 Watt',
                'slug'          => 'line-array-system-10000-watt',
                'description'   => 'Rasakan kualitas audio konser profesional di event Anda. Sistem Line Array 10.000 Watt kami menggunakan speaker dari brand ternama dengan distribusi suara merata ke seluruh area penonton — dari barisan terdepan hingga sudut paling belakang.',
                'specifications'=> "Power Total: 10.000 Watt RMS\nKonfigurasi: 4 Line Array + 2 Sub Woofer (per sisi)\nAmplifier: Crown / Lab Gruppen\nMixer: Yamaha CL3 (Digital)\nProcessor: Lake / DBX\nMonitor: 4 unit Wedge",
                'capacity'      => 'Coverage: hingga 3000 penonton di ruang terbuka',
                'use_cases'     => 'Konser musik, gala dinner 500+ pax, festival, turnamen dengan live performance',
                'is_featured'   => true,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'sound-system',
                'name'          => 'Sound System Portable Meeting',
                'slug'          => 'sound-system-portable-meeting',
                'description'   => 'Solusi audio praktis untuk rapat, seminar, dan gathering skala kecil-menengah. Sistem portable yang mudah dipasang namun memberikan kualitas suara yang jernih dan merata.',
                'specifications'=> "Speaker: 2x JBL EON Series\nAmplifier: Built-in\nMixer: 8 Channel\nMic: 2 Wireless Handheld + 1 Clip-on\nStand: Adjustable Speaker Stand",
                'capacity'      => '50-200 peserta',
                'use_cases'     => 'Seminar, rapat perusahaan, wisuda, gathering, peresmian',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],

            // STAGE
            [
                'category_slug' => 'stage-backdrop',
                'name'          => 'Panggung Modular Portable',
                'slug'          => 'panggung-modular-portable',
                'description'   => 'Panggung modular serbaguna yang dapat dikonfigurasi sesuai kebutuhan. Konstruksi aluminium anodized yang ringan namun kuat, memudahkan pemasangan dan pembongkaran dalam waktu singkat tanpa mengorbankan kekokohan.',
                'specifications'=> "Material: Aluminium Anodized + Plywood\nTinggi: 60 cm / 90 cm / 120 cm (adjustable)\nBeban Maks: 750 kg/m²\nModul: 1×1 m, 1×2 m, 2×2 m\nAkses: Tangga + Handrail",
                'capacity'      => 'Luas custom mulai 3×4 m hingga 12×8 m',
                'use_cases'     => 'Konser, fashion show, seminar, pelantikan, wisuda, pernikahan',
                'is_featured'   => true,
                'sort_order'    => 1,
            ],

            // LIGHTING
            [
                'category_slug' => 'lighting-pendingin',
                'name'          => 'Lighting Package Concert',
                'slug'          => 'lighting-package-concert',
                'description'   => 'Ciptakan atmosfer panggung yang memukau dengan Paket Lighting Concert kami. Kombinasi moving head, par LED, strobe, dan hazer dirancang untuk menghadirkan show lighting spektakuler yang akan membuat penonton terkesima.',
                'specifications'=> "Moving Head: 8 unit Beam + 4 unit Spot\nPar LED: 20 unit RGBWA\nStrobe: 4 unit\nHazer: 1 unit\nController: GrandMA 2 OnPC\nTruss: Custom layout",
                'capacity'      => 'Ideal untuk panggung 6×4 m hingga 12×8 m',
                'use_cases'     => 'Konser musik, festival, gala dinner, award ceremony',
                'is_featured'   => true,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'lighting-pendingin',
                'name'          => 'AC Portable 2 PK Industrial',
                'slug'          => 'ac-portable-2-pk-industrial',
                'description'   => 'Jaga kenyamanan tamu dengan AC Portable Industrial 2 PK. Sistem pendingin bertenaga tinggi yang dapat menjangkau area luas, cocok untuk tenda besar, aula tanpa AC sentral, atau ruang darurat.',
                'specifications'=> "Kapasitas: 2 PK (18.000 BTU)\nAliran Udara: 1200 m³/jam\nJangkauan: 30-50 m²\nBahan Bakar: Listrik (2200 Watt)\nSelang Pembuangan: 5 m",
                'capacity'      => 'Menjangkau area 30-50 m², cocok untuk tenda 5×10 m',
                'use_cases'     => 'Tenda wedding, ruang VIP outdoor, posko darurat, pameran',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],

            // FURNITURE
            [
                'category_slug' => 'furniture',
                'name'          => 'Set Meja Bundar + Kursi Chiavari',
                'slug'          => 'set-meja-bundar-kursi-chiavari',
                'description'   => 'Hadirkan kesan mewah dan elegan pada reception area event Anda. Meja bundar diameter 180 cm dipadukan dengan kursi Chiavari gold yang ikonik — pilihan utama untuk wedding reception, gala dinner, dan event formal bergengsi.',
                'specifications'=> "Meja: Diameter 180 cm, kapasitas 8-10 kursi\nKursi: Chiavari Gold / Silver / White\nBahan Meja: Kayu + MDF, Finishing HPL\nBahan Kursi: Aluminium Cat Powder\nKusyen: Tersedia (+biaya tambahan)",
                'capacity'      => 'Per set: 1 meja + 8 kursi (kapasitas 8-10 pax)',
                'use_cases'     => 'Wedding reception, gala dinner, reuni, corporate dinner',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],

            // FLOORING
            [
                'category_slug' => 'flooring-karpet',
                'name'          => 'Parket Floating Vinyl Wood',
                'slug'          => 'parket-floating-vinyl-wood',
                'description'   => 'Transformasikan area event Anda dengan lantai parket vinyl premium yang memberikan kesan natural dan hangat. Sistem floating memudahkan pemasangan dan pembongkaran tanpa merusak lantai asli lokasi.',
                'specifications'=> "Material: Vinyl SPC (Stone Plastic Composite)\nMotif: Wood Natural / Herringbone\nTebal: 5 mm + Underlayer 2 mm\nAnti-slip: Ya\nTahan Air: Ya",
                'capacity'      => 'Per lembar 122×20 cm; tersedia hingga 1000 m²',
                'use_cases'     => 'Wedding venue, pameran, fashion show, gala dinner, showroom pop-up',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'flooring-karpet',
                'name'          => 'Karpet Event Premium',
                'slug'          => 'karpet-event-premium',
                'description'   => 'Karpet dengan permukaan rapi membantu menyatukan area acara, memberi pijakan yang nyaman, dan menjaga tampilan venue tetap tertata.',
                'specifications'=> "Pilihan warna: Merah, abu-abu, hitam\nLebar roll: 2 m\nFinishing tepi dapat disesuaikan\nPemasangan mengikuti ukuran area",
                'capacity'      => 'Area pemasangan menyesuaikan layout venue',
                'use_cases'     => 'Pameran, jalur tamu, panggung, ballroom, area registrasi',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'toilet-portable',
                'name'          => 'Toilet Portable Standar Event',
                'slug'          => 'toilet-portable-standar-event',
                'description'   => 'Fasilitas sanitasi praktis untuk lokasi acara tanpa toilet permanen. Unit dapat ditempatkan dekat area kegiatan dengan penjadwalan layanan yang disepakati.',
                'specifications'=> "Konstruksi: Modular portable\nFitur: Ventilasi dan pengunci pintu\nLayanan: Penempatan dan penjemputan\nPerawatan: Jadwal layanan dapat dibahas",
                'capacity'      => 'Kapasitas penggunaan mengikuti durasi dan jumlah pengunjung',
                'use_cases'     => 'Festival, konser outdoor, turnamen, proyek, area pameran sementara',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'toilet-portable',
                'name'          => 'Toilet Portable Premium',
                'slug'          => 'toilet-portable-premium',
                'description'   => 'Pilihan fasilitas yang lebih nyaman untuk tamu VIP dan acara dengan kebutuhan presentasi yang terjaga.',
                'specifications'=> "Interior: Finishing premium\nFitur: Pencahayaan, ventilasi, dan cermin\nKebutuhan utilitas dikonfirmasi sebelum penempatan",
                'capacity'      => 'Konfigurasi unit mengikuti estimasi pengunjung',
                'use_cases'     => 'Wedding, corporate gathering, area VIP festival, acara outdoor',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'smart-tv',
                'name'          => 'Smart TV 55 Inci',
                'slug'          => 'smart-tv-55-inci',
                'description'   => 'Layar ringkas untuk materi presentasi dan konten visual yang mudah dilihat dari area dekat tanpa instalasi layar besar.',
                'specifications'=> "Ukuran layar: 55 inci\nResolusi: 4K UHD\nMasukan: HDMI dan USB\nTermasuk: Stand display",
                'capacity'      => 'Ideal untuk ruang rapat dan kelompok kecil',
                'use_cases'     => 'Meeting, booth pameran, ruang tunggu, pemutaran materi',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'smart-tv',
                'name'          => 'Smart TV 75 Inci',
                'slug'          => 'smart-tv-75-inci',
                'description'   => 'Ukuran layar lebih besar membantu presentasi, video, dan informasi acara terlihat jelas di ruang yang lebih luas.',
                'specifications'=> "Ukuran layar: 75 inci\nResolusi: 4K UHD\nMasukan: HDMI dan USB\nDapat dipasang di stand atau bracket sesuai venue",
                'capacity'      => 'Diagonal layar 75 inci',
                'use_cases'     => 'Seminar, area sponsor, konferensi, pemutaran konten',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'stage-backdrop',
                'name'          => 'Backdrop Modular Acara',
                'slug'          => 'backdrop-modular-acara',
                'description'   => 'Bidang visual modular untuk membingkai panggung dan memperkuat identitas acara melalui grafis yang disiapkan penyelenggara.',
                'specifications'=> "Rangka: Sistem modular\nBidang cetak: Material sesuai kebutuhan venue\nUkuran dan metode pemasangan mengikuti survei\nFile desain disiapkan atau dikonfirmasi bersama klien",
                'capacity'      => 'Ukuran menyesuaikan desain dan dimensi panggung',
                'use_cases'     => 'Konferensi, wisuda, wedding, peluncuran produk, festival',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'furniture',
                'name'          => 'Kursi Futura Susun',
                'slug'          => 'kursi-futura-susun',
                'description'   => 'Kursi ringan yang mudah ditata dan disusun kembali, membantu alur persiapan serta pengaturan tempat duduk lebih efisien.',
                'specifications'=> "Tipe: Kursi Futura\nRangka: Plastik dengan kaki besi\nPilihan warna dikonfirmasi saat konsultasi\nDapat dilengkapi sarung kursi",
                'capacity'      => 'Penataan mengikuti denah dan kebutuhan jumlah tamu',
                'use_cases'     => 'Seminar, wisuda, rapat, registrasi, acara komunitas',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'partisi',
                'name'          => 'Partisi Booth Modular',
                'slug'          => 'partisi-booth-modular',
                'description'   => 'Sistem pembatas modular yang membantu membentuk booth secara konsisten dan menata alur kunjungan di area pameran.',
                'specifications'=> "Sistem: Panel modular dan rangka\nFinishing: Warna standar atau grafis tambahan\nTinggi serta konfigurasi dapat disesuaikan venue",
                'capacity'      => 'Konfigurasi booth mengikuti denah dan ukuran area',
                'use_cases'     => 'Pameran, expo, bazaar, ruang registrasi, area sponsor',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'partisi',
                'name'          => 'Partisi Pembatas Ruang',
                'slug'          => 'partisi-pembatas-ruang',
                'description'   => 'Pembagian ruang sementara untuk menjaga alur peserta, membentuk area operasional, atau memberi privasi pada bagian tertentu.',
                'specifications'=> "Panel modular ringan\nTinggi dan panjang mengikuti kebutuhan\nDapat dipadukan dengan signage acara",
                'capacity'      => 'Panjang pemasangan menyesuaikan denah lokasi',
                'use_cases'     => 'Ruang backstage, ruang tunggu, alur antrean, area kerja panitia',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'perangkat-komunikasi',
                'name'          => 'Radio Komunikasi Event',
                'slug'          => 'radio-komunikasi-event',
                'description'   => 'Komunikasi langsung antar kru membantu koordinasi lapangan tetap ringkas saat area acara ramai dan berpindah-pindah.',
                'specifications'=> "Radio genggam UHF\nBaterai isi ulang\nKelengkapan: Charger dan earpiece\nPembagian kanal dibahas saat persiapan",
                'capacity'      => 'Jumlah unit mengikuti jumlah koordinator dan zona kerja',
                'use_cases'     => 'Festival, konser, pameran, venue luas, koordinasi produksi',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'perangkat-komunikasi',
                'name'          => 'Headset Interkom Kru',
                'slug'          => 'headset-interkom-kru',
                'description'   => 'Jalur bicara untuk kru inti menjaga instruksi teknis lebih jelas tanpa mengandalkan pengeras suara.',
                'specifications'=> "Perangkat interkom untuk kru\nHeadset dengan mikrofon\nRute komunikasi disesuaikan pembagian tugas",
                'capacity'      => 'Kanal dan jumlah pengguna ditentukan berdasarkan struktur tim',
                'use_cases'     => 'Panggung, operator audio-visual, pengarah acara, produksi siaran',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
            [
                'category_slug' => 'produksi-branding',
                'name'          => 'Signage dan Arah Acara',
                'slug'          => 'signage-arah-acara',
                'description'   => 'Penanda visual membantu peserta menemukan area registrasi, panggung, ruang, dan fasilitas dengan lebih mudah.',
                'specifications'=> "Produksi sesuai materi grafis yang disetujui\nPilihan media dan ukuran dibahas sesuai penempatan\nProof desain disetujui sebelum produksi",
                'capacity'      => 'Jumlah titik dan ukuran disesuaikan denah venue',
                'use_cases'     => 'Konferensi, pameran, festival, corporate gathering, wedding',
                'is_featured'   => false,
                'sort_order'    => 1,
            ],
            [
                'category_slug' => 'produksi-branding',
                'name'          => 'Backdrop Cetak dan X-Banner',
                'slug'          => 'backdrop-cetak-x-banner',
                'description'   => 'Media branding yang konsisten memperkuat identitas acara di titik utama dan area informasi pengunjung.',
                'specifications'=> "Pilihan media: Flexi atau kain sesuai lokasi\nUkuran: Berdasarkan kebutuhan desain\nMateri visual diserahkan dalam format siap cetak",
                'capacity'      => 'Ukuran dan jumlah unit dikonfirmasi berdasarkan layout',
                'use_cases'     => 'Media briefing, meja registrasi, booth, photo area, peluncuran produk',
                'is_featured'   => false,
                'sort_order'    => 2,
            ],
        ];

        foreach ($products as $data) {
            $categorySlug = $data['category_slug'];
            unset($data['category_slug']);

            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $data['category_id'] = $category->id;
                $data['is_active']   = true;
                Product::updateOrCreate(['slug' => $data['slug']], $data);
            }
        }
    }
}
