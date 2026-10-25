<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlogPost extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id', 'blog_category_id', 'title', 'slug', 'excerpt',
        'content', 'is_featured', 'is_published', 'published_at',
        'meta_title', 'meta_description', 'focus_keyword',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
            if (empty($model->excerpt) && !empty($model->content)) {
                $model->excerpt = Str::limit(strip_tags($model->content), 200);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useDisk(config('media-library.disk_name', 'public'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (! config('media.conversions_enabled', true)) {
            return;
        }

        $this->addMediaConversion('thumb')
            ->width(800)->height(500)->format('webp')->quality(80);
        $this->addMediaConversion('large')
            ->width(1600)->height(1000)->format('webp')->quality(85);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now())
                     ->orderBy('published_at', 'desc');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFeaturedImageUrl(string $conversion = 'thumb'): string
    {
        $media = $this->getFirstMedia('featured_image');
        return $media
            ? $media->getUrl(config('media.conversions_enabled', true) ? $conversion : '')
            : asset('images/placeholder-product.svg');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));
        return (int) ceil($words / 200);
    }
}
