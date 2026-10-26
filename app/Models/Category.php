<?php

namespace App\Models;

use App\Casts\DatabaseBoolean;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'icon',
        'meta_title', 'meta_description', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => DatabaseBoolean::class];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('sort_order');
    }

    public function activeProducts()
    {
        return $this->hasMany(Product::class)->whereRaw('is_active IS TRUE')->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->whereRaw('is_active IS TRUE')->orderBy('sort_order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
