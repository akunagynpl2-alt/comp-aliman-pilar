<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $records = Portfolio::latest('event_date')->paginate(20);

        return view('admin.resources.index', [
            'title' => 'Portofolio',
            'records' => $records,
            'columns' => [
                ['name' => 'title', 'label' => 'Nama event'],
                ['name' => 'client', 'label' => 'Klien'],
                ['name' => 'event_type', 'label' => 'Jenis acara'],
                ['name' => 'is_active', 'label' => 'Status', 'type' => 'checkbox'],
            ],
            'routeName' => 'admin.portofolio',
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
        $portfolio = Portfolio::create($data);
        $this->storeImages($portfolio, $images);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio): View
    {
        return $this->form($portfolio);
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $this->validatedData($request, $portfolio);
        $images = $data['images'] ?? [];
        unset($data['images']);
        $portfolio->update($data);
        $this->storeImages($portfolio, $images);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil dihapus.');
    }

    public function deleteMedia(Portfolio $portfolio, Media $media): RedirectResponse
    {
        abort_unless(
            $media->model_id === $portfolio->id
            && $media->model_type === $portfolio::class
            && in_array($media->collection_name, ['images', 'cover'], true),
            404
        );

        $media->delete();

        return back()->with('success', 'Foto portofolio berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Portfolio $portfolio = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'max:255', Rule::unique('portfolios', 'slug')->ignore($portfolio?->id)],
            'client' => ['nullable', 'string', 'max:255'],
            'event_type' => ['required', 'string', 'max:100'],
            'event_date' => ['nullable', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'content' => ['nullable', 'string', 'max:10000'],
            'equipment_used' => ['nullable', 'string', 'max:3000'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'images' => ['nullable', 'array', 'max:12'],
            'images.*' => ['image', 'mimes:jpeg,png,webp', 'max:4096'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['equipment_used'] = collect(preg_split('/\r\n|\r|\n/', $data['equipment_used'] ?? ''))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function storeImages(Portfolio $portfolio, array $images): void
    {
        foreach ($images as $image) {
            $portfolio->addMedia($image)->toMediaCollection('images');
        }
    }

    private function form(?Portfolio $portfolio = null): View
    {
        $fields = [
            ['name' => 'title', 'label' => 'Judul acara', 'type' => 'text'],
            ['name' => 'slug', 'label' => 'Slug URL (opsional)', 'type' => 'text'],
            ['name' => 'client', 'label' => 'Klien / mitra', 'type' => 'text'],
            ['name' => 'event_type', 'label' => 'Jenis acara', 'type' => 'text'],
            ['name' => 'event_date', 'label' => 'Tanggal acara', 'type' => 'date'],
            ['name' => 'location', 'label' => 'Lokasi', 'type' => 'text'],
            ['name' => 'description', 'label' => 'Ringkasan acara', 'type' => 'textarea'],
            ['name' => 'content', 'label' => 'Cerita / detail acara', 'type' => 'textarea'],
            ['name' => 'equipment_used', 'label' => 'Peralatan (satu item per baris)', 'type' => 'textarea'],
            ['name' => 'images', 'label' => 'Foto event (maks. 12, 4 MB per foto)', 'type' => 'file', 'multiple' => true],
            ['name' => 'is_featured', 'label' => 'Event unggulan', 'type' => 'checkbox'],
            ['name' => 'is_active', 'label' => 'Tampilkan di situs', 'type' => 'checkbox'],
            ['name' => 'meta_title', 'label' => 'Meta title', 'type' => 'text', 'maxlength' => 60],
            ['name' => 'meta_description', 'label' => 'Meta description', 'type' => 'textarea', 'maxlength' => 160],
        ];
        if ($portfolio) {
            $portfolio->equipment_used = implode("\n", $portfolio->equipment_used ?? []);
        }

        return view('admin.resources.form', [
            'title' => 'Portofolio',
            'record' => $portfolio,
            'fields' => $fields,
            'routeName' => 'admin.portofolio',
        ]);
    }
}
