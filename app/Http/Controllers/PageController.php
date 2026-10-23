<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\WhatsappNumber;
use App\Models\WhatsappTemplate;
use Artesaos\SEOTools\Facades\SEOMeta;

class PageController extends Controller
{
    public function about()
    {
        SEOMeta::setTitle('Tentang Kami | Aliman Pilar Production');
        SEOMeta::setDescription('Kenali Aliman Pilar Production — perusahaan sewa perlengkapan event berpengalaman 10+ tahun, melayani wedding, corporate, festival, dan pameran.');
        return view('pages.about');
    }

    public function howToOrder()
    {
        $whatsappNumbers = WhatsappNumber::active()->get();
        SEOMeta::setTitle('Cara Pemesanan | Aliman Pilar Production');
        SEOMeta::setDescription('Cara mudah menyewa perlengkapan event dari Aliman Pilar Production. Cukup 4 langkah, langsung konsultasi via WhatsApp.');
        return view('pages.how-to-order', compact('whatsappNumbers'));
    }

    public function privacyPolicy()
    {
        SEOMeta::setTitle('Kebijakan Privasi | Aliman Pilar Production');
        return view('pages.privacy-policy');
    }

    public function terms()
    {
        SEOMeta::setTitle('Syarat & Ketentuan Layanan | Aliman Pilar Production');
        return view('pages.terms');
    }
}
