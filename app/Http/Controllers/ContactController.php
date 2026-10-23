<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\WhatsappNumber;
use App\Models\WhatsappTemplate;
use App\Models\SiteSetting;
use App\Http\Requests\ContactFormRequest;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $whatsappNumbers = WhatsappNumber::active()->get();

        SEOMeta::setTitle('Kontak & Konsultasi | Aliman Pilar Production');
        SEOMeta::setDescription('Hubungi Aliman Pilar Production untuk konsultasi kebutuhan perlengkapan event Anda. Tersedia via WhatsApp, email, dan telepon.');

        return view('contact.index', compact('whatsappNumbers'));
    }

    public function store(ContactFormRequest $request)
    {
        $message = ContactMessage::create([
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'event_type'     => $request->event_type,
            'event_date'     => $request->event_date,
            'event_location' => $request->event_location,
            'needs'          => $request->needs,
            'ip_address'     => $request->ip(),
        ]);

        // Build WhatsApp redirect URL
        $waMessage = WhatsappTemplate::render('contact', [
            'name'           => $request->name,
            'event_type'     => $request->event_type ?? '-',
            'event_date'     => $request->event_date ?? '-',
            'event_location' => $request->event_location ?? '-',
            'needs'          => $request->needs,
        ]);

        return redirect()->route('contact.index')
            ->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.')
            ->with('wa_message', $waMessage);
    }
}
