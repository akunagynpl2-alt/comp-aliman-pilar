<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['blogCategory', 'author'])->published();

        if ($request->filled('kategori')) {
            $query->whereHas('blogCategory', fn($q) => $q->where('slug', $request->kategori));
        }

        if ($request->filled('cari')) {
            $search = $request->cari;
            $query->where(fn($q) => $q
                ->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")
            );
        }

        $posts      = $query->paginate(9)->withQueryString();
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])->get();
        $featured   = BlogPost::with('blogCategory')->published()->whereRaw('is_featured IS TRUE')->first();

        SEOMeta::setTitle('Blog & Tips Event | Aliman Pilar Production');
        SEOMeta::setDescription('Artikel dan tips seputar event organizer, sewa perlengkapan event, dan inspirasi acara dari pakarnya.');

        return view('blog.index', compact('posts', 'categories', 'featured'));
    }

    public function show(BlogPost $blogPost)
    {
        if (!$blogPost->is_published) {
            abort(404);
        }

        $related = BlogPost::published()
            ->where('blog_category_id', $blogPost->blog_category_id)
            ->where('id', '!=', $blogPost->id)
            ->take(3)->get();

        $title = ($blogPost->meta_title ?: $blogPost->title) . ' | Aliman Pilar Production';
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($blogPost->meta_description ?: $blogPost->excerpt);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($blogPost->meta_description ?: $blogPost->excerpt);
        if ($blogPost->getFirstMedia('featured_image')) {
            OpenGraph::addImage($blogPost->getFeaturedImageUrl('large'));
        }

        return view('blog.show', compact('blogPost', 'related'));
    }
}
