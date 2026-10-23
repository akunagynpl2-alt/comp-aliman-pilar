<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends ManagedResourceController
{
    protected string $modelClass = BlogCategory::class;
    protected string $routeName = 'admin.blog-kategori';
    protected string $title = 'Kategori blog';

    protected function fields(): array
    {
        return [['name' => 'name', 'label' => 'Nama kategori', 'type' => 'text']];
    }

    protected function validationRules(?int $id = null): array
    {
        return ['name' => ['required', 'string', 'max:100']];
    }

    protected function prepareData(array $data, Request $request, ?Model $record = null): array
    {
        return parent::prepareData($data, $request, $record) + ['slug' => Str::slug($data['name'])];
    }
}
