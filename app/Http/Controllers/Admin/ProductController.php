<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index(): View
    {
        $records = Product::with(['category', 'media'])->orderBy('sort_order')->orderBy('name')->paginate(20);

        return view('admin.resources.index', [
            'title' => 'Produk',
            'records' => $records,
            'columns' => [
                ['name' => 'thumbnail', 'label' => 'Foto', 'type' => 'product-image'],
                ['name' => 'name', 'label' => 'Produk'],
                ['name' => 'category.name', 'label' => 'Kategori'],
                ['name' => 'capacity', 'label' => 'Kapasitas'],
                ['name' => 'is_active', 'label' => 'Status', 'type' => 'checkbox'],
            ],
            'routeName' => 'admin.produk',
        ]);
    }

    public function create(): View
    {
        return $this->form();
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $images = $data['images'] ?? [];
        unset($data['images']);
        $product = Product::create($data);
        $this->storeImages($product, $images);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return $this->form($product);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validatedData($request, $product);
        $images = $data['images'] ?? [];
        unset($data['images']);
        $product->update($data);
        $this->storeImages($product, $images);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function deleteMedia(Product $product, Media $media): RedirectResponse
    {
        abort_unless(
            $media->model_id === $product->id
            && $media->model_type === $product::class
            && in_array($media->collection_name, ['images', 'thumbnail'], true),
            404
        );

        $media->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'max:255', Rule::unique('products', 'slug')->ignore($product?->id)],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string', 'max:10000'],
            'specifications' => ['nullable', 'string', 'max:5000'],
            'capacity' => ['nullable', 'string', 'max:255'],
            'use_cases' => ['nullable', 'string', 'max:5000'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpeg,png,webp', 'max:4096'],
        ]) + [
            'slug' => $request->input('slug') ?: Str::slug($request->input('name')),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->integer('sort_order', 0),
        ];
    }

    private function storeImages(Product $product, array $images): void
    {
        foreach ($images as $image) {
            $product->addMedia($image)->toMediaCollection('images');
        }
    }

    private function form(?Product $product = null): View
    {
        $categories = Category::active()->get();
        $fields = [
            ['name' => 'name', 'label' => 'Nama produk', 'type' => 'text'],
            ['name' => 'slug', 'label' => 'Slug URL (opsional, otomatis dari nama)', 'type' => 'text'],
            ['name' => 'category_id', 'label' => 'Kategori', 'type' => 'select', 'options' => $categories->pluck('name', 'id')->all()],
            ['name' => 'description', 'label' => 'Deskripsi manfaat', 'type' => 'textarea'],
            ['name' => 'specifications', 'label' => 'Spesifikasi teknis', 'type' => 'textarea'],
            ['name' => 'capacity', 'label' => 'Kapasitas / ukuran', 'type' => 'text'],
            ['name' => 'use_cases', 'label' => 'Contoh penggunaan', 'type' => 'textarea'],
            ['name' => 'images', 'label' => 'Foto produk (maks. 10, 4 MB per foto)', 'type' => 'file', 'multiple' => true],
            ['name' => 'is_featured', 'label' => 'Produk unggulan', 'type' => 'checkbox'],
            ['name' => 'is_active', 'label' => 'Tampilkan di katalog', 'type' => 'checkbox'],
            ['name' => 'sort_order', 'label' => 'Urutan tampil', 'type' => 'number'],
            ['name' => 'meta_title', 'label' => 'Meta title', 'type' => 'text', 'maxlength' => 60],
            ['name' => 'meta_description', 'label' => 'Meta description', 'type' => 'textarea', 'maxlength' => 160],
        ];

        return view('admin.resources.form', [
            'title' => 'Produk',
            'record' => $product,
            'fields' => $fields,
            'routeName' => 'admin.produk',
        ]);
    }
}
