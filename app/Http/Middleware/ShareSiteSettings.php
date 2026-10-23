<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use App\Models\WhatsappNumber;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareSiteSettings
{
    public function handle(Request $request, Closure $next): Response
    {
        // Share frequently used settings to all views
        View::share('settings', [
            'site_name'       => SiteSetting::get('site_name', 'Aliman Pilar Production'),
            'site_tagline'    => SiteSetting::get('site_tagline', 'Pilar Penopang Acara Anda'),
            'phone_main'      => SiteSetting::get('phone_main', ''),
            'email'           => SiteSetting::get('email', ''),
            'address'         => SiteSetting::get('address', ''),
            'google_maps_embed' => SiteSetting::get('google_maps_embed', ''),
            'instagram'       => SiteSetting::get('instagram', ''),
            'facebook'        => SiteSetting::get('facebook', ''),
            'youtube'         => SiteSetting::get('youtube', ''),
            'operating_hours' => SiteSetting::get('operating_hours', ''),
            'service_areas'   => SiteSetting::get('service_areas', ''),
            'stat_events'     => SiteSetting::get('stat_events', '500+'),
            'stat_years'      => SiteSetting::get('stat_years', '10+'),
            'stat_clients'    => SiteSetting::get('stat_clients', '200+'),
            'stat_products'   => SiteSetting::get('stat_products', '1000+'),
        ]);

        // Share primary WhatsApp number
        $whatsappNumbers = WhatsappNumber::active()->get();
        View::share('whatsappNumbers', $whatsappNumbers);
        View::share('primaryWa', $whatsappNumbers->first());

        return $next($request);
    }
}
