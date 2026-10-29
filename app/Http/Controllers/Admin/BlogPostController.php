<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $records = BlogPost::with('blogCategory')->latest()->paginate(20);

        return view('admin.resources.index', [
            'title' => 'Artikel blog',
            'records' => $records,
            'columns' => [
                ['name' => 'title', 'label' => 'Judul'],
                ['name' => 'blogCategory.name', 'label' => 'Kategori'],
                ['name' => 'is_published', 'label' => 'Status', 'type' => 'checkbox'],
                ['name' => 'published_at', 'label' => 'Tanggal terbit'],
            ],
            'routeName' => 'admin.blog',
        ]);
    }

    public function create(): View
    {
        return $this->form();
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $image = $data['featured_image'] ?? null;
        unset($data['featured_image']);
        $data['user_id'] = $request->user()->id;
        $post = BlogPost::create($data);
        if ($image) {
            $post->addMedia($image)->toMediaCollection('featured_image');
        }

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(string $blog): View
    {
        return $this->form(BlogPost::findOrFail($blog));
    }

    public function update(Request $request, string $blog): RedirectResponse
    {
        $blog = BlogPost::findOrFail($blog);
        $data = $this->validatedData($request, $blog);
        $image = $data['featured_image'] ?? null;
        unset($data['featured_image']);
        $blog->update($data);
        if ($image) {
            $blog->addMedia($image)->toMediaCollection('featured_image');
        }

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(string $blog): RedirectResponse
    {
        BlogPost::findOrFail($blog)->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function validatedData(Request $request, ?BlogPost $post = null): array
    {
        $slug = $request->input('slug');
        if (! is_string($slug) || trim($slug) === '') {
            $slug = $post?->slug ?? Str::slug((string) $request->input('title', ''));
        }
        $request->merge(['slug' => $slug]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('blog_posts', 'slug')->ignore($post?->id)],
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:30000'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'focus_keyword' => ['nullable', 'string', 'max:100'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = $post?->published_at ?? now();
        }

        return $data;
    }

    private function form(?BlogPost $post = null): View
    {
        $categories = BlogCategory::query()->orderBy('name')->get();
        $fields = [
            ['name' => 'title', 'label' => 'Judul artikel', 'type' => 'text'],
            ['name' => 'slug', 'label' => 'Slug URL (opsional)', 'type' => 'text'],
            ['name' => 'blog_category_id', 'label' => 'Kategori artikel', 'type' => 'select', 'options' => $categories->pluck('name', 'id')->all(), 'nullable' => true],
            ['name' => 'excerpt', 'label' => 'Ringkasan', 'type' => 'textarea'],
            ['name' => 'content', 'label' => 'Isi artikel (teks biasa)', 'type' => 'textarea'],
            ['name' => 'featured_image', 'label' => 'Foto utama (JPEG, PNG, WebP, maks. 4 MB)', 'type' => 'file'],
            ['name' => 'is_featured', 'label' => 'Artikel unggulan', 'type' => 'checkbox'],
            ['name' => 'is_published', 'label' => 'Terbitkan', 'type' => 'checkbox'],
            ['name' => 'published_at', 'label' => 'Tanggal terbit', 'type' => 'datetime-local'],
            ['name' => 'focus_keyword', 'label' => 'Kata kunci fokus', 'type' => 'text'],
            ['name' => 'meta_title', 'label' => 'Meta title', 'type' => 'text', 'maxlength' => 60],
            ['name' => 'meta_description', 'label' => 'Meta description', 'type' => 'textarea', 'maxlength' => 160],
        ];

        return view('admin.resources.form', [
            'title' => 'Artikel blog',
            'record' => $post,
            'fields' => $fields,
            'routeName' => 'admin.blog',
        ]);
    }
}
