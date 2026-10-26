<?php

namespace App\Models;

use App\Casts\DatabaseBoolean;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'specifications',
        'capacity', 'use_cases', 'is_featured', 'is_active',
        'meta_title', 'meta_description', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => DatabaseBoolean::class,
        'is_active'   => DatabaseBoolean::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk(config('media-library.disk_name', 'public'));

        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->useDisk(config('media-library.disk_name', 'public'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (! config('media.conversions_enabled', true)) {
            return;
        }

        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(450)
            ->format('webp')
            ->quality(80)
            ->performOnCollections('images', 'thumbnail');

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(900)
            ->format('webp')
            ->quality(85)
            ->performOnCollections('images', 'thumbnail');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->whereRaw('is_active IS TRUE')->orderBy('sort_order')->orderBy('name');
    }

    public function scopeFeatured($query)
    {
        return $query->whereRaw('is_featured IS TRUE')->whereRaw('is_active IS TRUE');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get thumbnail image URL with fallback.
     */
    public function getThumbnailUrl(string $conversion = 'thumb'): string
    {
        $media = $this->getFirstMedia('thumbnail') ?? $this->getFirstMedia('images');
        if ($media) {
            return $media->getUrl(config('media.conversions_enabled', true) ? $conversion : '');
        }
        return asset('images/placeholder-product.svg');
    }

    /**
     * Build WhatsApp message for this product.
     */
    public function getWhatsappMessage(): string
    {
        return WhatsappTemplate::render('product', [
            'product_name'     => $this->name,
            'category_name'    => $this->category->name ?? '',
            'product_capacity' => $this->capacity ?? '',
        ]);
    }
}
