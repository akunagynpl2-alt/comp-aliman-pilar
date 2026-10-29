<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\WhatsappNumber;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()
            ->withCount(['activeProducts as active_products_count' => fn ($query) => $query->withImages()])
            ->get();

        $query = Product::with(['category', 'media'])
            ->active()
            ->withImages()
            ->whereHas('category', fn ($query) => $query->whereRaw('is_active IS TRUE'));

        if ($request->filled('kategori')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->kategori));
        }

        if ($request->filled('cari')) {
            $search = $request->cari;
            $query->where(fn ($q) => $q
                ->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('capacity', 'like', "%{$search}%")
            );
        }

        $products = $query->paginate(12)->withQueryString();

        $selectedCategory = $request->filled('kategori')
            ? Category::where('slug', $request->kategori)->first()
            : null;

        SEOMeta::setTitle('Produk Sewa Perlengkapan Event | Aliman Pilar Production');
        SEOMeta::setDescription('Temukan perlengkapan event terlengkap: tenda, genset, LED screen, sound system, stage, lighting, dan lebih banyak lagi.');

        return view('catalog.index', compact('categories', 'products', 'selectedCategory'));
    }

    public function show(Product $product)
    {
        $product->loadMissing('category');

        abort_unless(
            $product->is_active
            && $product->category?->is_active
            && ($product->getFirstMedia('images') || $product->getFirstMedia('thumbnail')),
            404
        );

        // Produk terkait dari kategori yang sama
        $relatedProducts = Product::active()->withImages()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        $whatsappNumbers = WhatsappNumber::active()->get();

        $title = ($product->meta_title ?: "Sewa {$product->name}").' | Aliman Pilar Production';
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($product->meta_description ?: substr(strip_tags($product->description), 0, 160));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($product->meta_description ?: substr(strip_tags($product->description), 0, 160));
        if ($product->getFirstMedia('images') || $product->getFirstMedia('thumbnail')) {
            OpenGraph::addImage($product->getThumbnailUrl('large'));
        }

        return view('catalog.show', compact('product', 'relatedProducts', 'whatsappNumbers'));
    }
}
