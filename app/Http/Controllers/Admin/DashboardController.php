<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with key statistics.
     */
    public function index()
    {
        $stats = [
            'total_products'    => Product::count(),
            'total_categories'  => Category::count(),
            'total_portfolios'  => Portfolio::count(),
            'total_blog_posts'  => BlogPost::count(),
            'total_testimonials'=> Testimonial::count(),
            'unread_messages'   => ContactMessage::query()->whereRaw('is_read IS FALSE')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
