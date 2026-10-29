<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Client;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

class HomeController extends Controller
{
    public function index()
    {
        $productsWithPhotos = Product::query()
            ->whereRaw('is_active IS TRUE')
            ->withImages();

        $categories = Category::active()
            ->whereHas('activeProducts', fn ($query) => $query->withImages())
            ->withCount(['activeProducts as active_products_count' => fn ($query) => $query->withImages()])
            ->with(['activeProducts' => fn ($query) => $query->withImages()->with('media')])
            ->get();

        $featuredProducts = (clone $productsWithPhotos)
            ->with(['category', 'media'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(8)
            ->get();
        $featuredPortfolios = Portfolio::featured()->take(6)->get();
        $testimonials = Testimonial::featured()->take(5)->get();
        $clients = Client::active()->get();
        $latestPosts = BlogPost::with('blogCategory')->published()->take(3)->get();
        $totalProducts = (clone $productsWithPhotos)->count();

        $siteName = SiteSetting::get('site_name', 'Aliman Pilar Production');
        $tagline = SiteSetting::get('site_tagline', 'Pilar Penopang Acara Anda');

        SEOMeta::setTitle($siteName.' — '.$tagline);
        SEOMeta::setDescription(SiteSetting::get('site_description'));
        SEOMeta::setKeywords(SiteSetting::get('site_keywords'));
        OpenGraph::setTitle($siteName.' — '.$tagline);
        OpenGraph::setDescription(SiteSetting::get('site_description'));

        return view('home', compact(
            'categories', 'featuredProducts', 'featuredPortfolios',
            'testimonials', 'clients', 'latestPosts', 'totalProducts'
        ));
    }
}
