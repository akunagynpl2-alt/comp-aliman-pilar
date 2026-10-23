<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\BlogPost;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $staticPages = [
            ['url' => route('home'),          'priority' => 1.0,  'changefreq' => 'weekly'],
            ['url' => route('catalog.index'), 'priority' => 0.9,  'changefreq' => 'weekly'],
            ['url' => route('portfolio.index'),'priority' => 0.8, 'changefreq' => 'weekly'],
            ['url' => route('blog.index'),    'priority' => 0.7,  'changefreq' => 'daily'],
            ['url' => route('about'),         'priority' => 0.6,  'changefreq' => 'monthly'],
            ['url' => route('how-to-order'),  'priority' => 0.7,  'changefreq' => 'monthly'],
            ['url' => route('contact.index'), 'priority' => 0.6,  'changefreq' => 'monthly'],
            ['url' => route('privacy-policy'), 'priority' => 0.2, 'changefreq' => 'yearly'],
            ['url' => route('terms'), 'priority' => 0.2, 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(Url::create($page['url'])
                ->setPriority($page['priority'])
                ->setChangeFrequency($page['changefreq']));
        }

        // Categories
        foreach (Category::active()->get() as $category) {
            $sitemap->add(Url::create(route('catalog.index', ['kategori' => $category->slug]))
                ->setPriority(0.8)->setChangeFrequency('weekly'));
        }

        // Products
        foreach (Product::active()->get() as $product) {
            $sitemap->add(Url::create(route('catalog.show', $product->slug))
                ->setLastModificationDate($product->updated_at)
                ->setPriority(0.8)->setChangeFrequency('monthly'));
        }

        // Portfolios
        foreach (Portfolio::active()->get() as $portfolio) {
            $sitemap->add(Url::create(route('portfolio.show', $portfolio->slug))
                ->setLastModificationDate($portfolio->updated_at)
                ->setPriority(0.7)->setChangeFrequency('monthly'));
        }

        // Blog posts
        foreach (BlogPost::published()->get() as $post) {
            $sitemap->add(Url::create(route('blog.show', $post->slug))
                ->setLastModificationDate($post->updated_at)
                ->setPriority(0.6)->setChangeFrequency('monthly'));
        }

        return response($sitemap->render(), 200, ['Content-Type' => 'application/xml']);
    }
}
