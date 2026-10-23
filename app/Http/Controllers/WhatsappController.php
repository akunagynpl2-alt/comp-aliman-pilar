<?php

namespace App\Http\Controllers;

use App\Models\WhatsappNumber;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WhatsappController extends Controller
{
    /**
     * Return active WhatsApp numbers as JSON (for Alpine.js popup).
     */
    public function numbers()
    {
        $numbers = WhatsappNumber::active()->get(['id', 'name', 'number']);
        return response()->json($numbers);
    }

    /**
     * Build a WhatsApp URL and redirect.
     */
    public function redirect(Request $request)
    {
        $validated = $request->validate([
            'number_id'    => ['required', Rule::exists('whatsapp_numbers', 'id')->where('is_active', true)],
            'template_key' => ['required', 'string', 'in:product,portfolio,general,contact'],
            'vars'         => ['nullable', 'array'],
        ]);

        $number  = WhatsappNumber::active()->findOrFail($validated['number_id']);
        $message = WhatsappTemplate::render($validated['template_key'], $validated['vars'] ?? []);

        $url = 'https://wa.me/' . $number->number . '?text=' . urlencode($message);

        return response()->json(['url' => $url]);
    }
}
