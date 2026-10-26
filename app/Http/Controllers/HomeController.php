<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Portfolio;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\SiteSetting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class HomeController extends Controller
{
    public function index()
    {
        $hasProductPhoto = fn ($query) => $query->whereHas('media', fn ($media) => $media
            ->whereIn('collection_name', ['images', 'thumbnail']));
        $productsWithPhotos = Product::query()
            ->whereRaw('is_active IS TRUE')
            ->whereHas('media', fn ($query) => $query->whereIn('collection_name', ['images', 'thumbnail']));

        $categories = Category::active()
            ->whereHas('activeProducts', $hasProductPhoto)
            ->withCount(['activeProducts as active_products_count' => $hasProductPhoto])
            ->with(['activeProducts' => fn ($query) => $hasProductPhoto($query)->with('media')])
            ->get();

        $featuredProducts = (clone $productsWithPhotos)
            ->with(['category', 'media'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(8)
            ->get();
        $featuredPortfolios = Portfolio::featured()->take(6)->get();
        $testimonials  = Testimonial::featured()->take(5)->get();
        $clients       = Client::active()->get();
        $latestPosts   = BlogPost::with('blogCategory')->published()->take(3)->get();
        $totalProducts = (clone $productsWithPhotos)->count();

        $siteName = SiteSetting::get('site_name', 'Aliman Pilar Production');
        $tagline  = SiteSetting::get('site_tagline', 'Pilar Penopang Acara Anda');

        SEOMeta::setTitle($siteName . ' — ' . $tagline);
        SEOMeta::setDescription(SiteSetting::get('site_description'));
        SEOMeta::setKeywords(SiteSetting::get('site_keywords'));
        OpenGraph::setTitle($siteName . ' — ' . $tagline);
        OpenGraph::setDescription(SiteSetting::get('site_description'));

        return view('home', compact(
            'categories', 'featuredProducts', 'featuredPortfolios',
            'testimonials', 'clients', 'latestPosts', 'totalProducts'
        ));
    }
}
