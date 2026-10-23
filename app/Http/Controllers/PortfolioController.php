<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\WhatsappNumber;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::active();

        if ($request->filled('jenis')) {
            $query->where('event_type', $request->jenis);
        }

        $portfolios  = $query->paginate(9)->withQueryString();
        $eventTypes = Portfolio::query()
            ->where('is_active', true)
            ->whereNotNull('event_type')
            ->select('event_type')
            ->distinct()
            ->orderBy('event_type')
            ->pluck('event_type');

        SEOMeta::setTitle('Portofolio Event | Aliman Pilar Production');
        SEOMeta::setDescription('Lihat portofolio event kami: wedding, corporate, festival, pameran, dan konser. Ratusan event sukses, ribuan tamu puas.');

        return view('portfolio.index', compact('portfolios', 'eventTypes'));
    }

    public function show(Portfolio $portfolio)
    {
        $whatsappNumbers = WhatsappNumber::active()->get();
        $relatedPortfolios = Portfolio::active()
            ->where('event_type', $portfolio->event_type)
            ->where('id', '!=', $portfolio->id)
            ->take(3)->get();

        $title = ($portfolio->meta_title ?: $portfolio->title) . ' | Aliman Pilar Production';
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($portfolio->meta_description ?: $portfolio->description);
        OpenGraph::setTitle($title);
        if ($portfolio->getFirstMedia('cover') || $portfolio->getFirstMedia('images')) {
            OpenGraph::addImage($portfolio->getCoverUrl('large'));
        }

        return view('portfolio.show', compact('portfolio', 'whatsappNumbers', 'relatedPortfolios'));
    }
}
