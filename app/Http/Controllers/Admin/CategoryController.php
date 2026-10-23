<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $records = Category::query()->orderBy('sort_order')->orderBy('name')->paginate(20);

        return view('admin.resources.index', [
            'title' => 'Kategori',
            'records' => $records,
            'columns' => [
                ['name' => 'name', 'label' => 'Nama'],
                ['name' => 'slug', 'label' => 'Slug'],
                ['name' => 'sort_order', 'label' => 'Urutan'],
                ['name' => 'is_active', 'label' => 'Status', 'type' => 'checkbox'],
            ],
            'routeName' => 'admin.kategori',
        ]);
    }

    public function create(): View
    {
        return $this->form();
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        Category::create($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category): View
    {
        return $this->form($category);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($this->validatedData($request, $category));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Category $category = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:3000'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
        ]);

        $data['slug'] = Str::slug($data['name']);
        if (Category::query()->where('slug', $data['slug'])->when($category, fn ($query) => $query->whereKeyNot($category->id))->exists()) {
            throw ValidationException::withMessages(['name' => 'Nama kategori menghasilkan slug yang sudah digunakan.']);
        }
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    private function form(?Category $category = null): View
    {
        $fields = [
            ['name' => 'name', 'label' => 'Nama kategori', 'type' => 'text'],
            ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea'],
            ['name' => 'icon', 'label' => 'Nama ikon (opsional)', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Urutan tampil', 'type' => 'number'],
            ['name' => 'is_active', 'label' => 'Aktif di katalog', 'type' => 'checkbox'],
            ['name' => 'meta_title', 'label' => 'Meta title', 'type' => 'text', 'maxlength' => 60],
            ['name' => 'meta_description', 'label' => 'Meta description', 'type' => 'textarea', 'maxlength' => 160],
        ];

        return view('admin.resources.form', [
            'title' => 'Kategori',
            'record' => $category,
            'fields' => $fields,
            'routeName' => 'admin.kategori',
        ]);
    }
}
