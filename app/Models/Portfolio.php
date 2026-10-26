<?php

namespace App\Models;

use App\Casts\DatabaseBoolean;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Portfolio extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title', 'slug', 'client', 'event_type', 'location',
        'event_date', 'description', 'content', 'equipment_used',
        'is_featured', 'is_active', 'meta_title', 'meta_description', 'sort_order',
    ];

    protected $casts = [
        'event_date'     => 'date',
        'equipment_used' => 'array',
        'is_featured'    => DatabaseBoolean::class,
        'is_active'      => DatabaseBoolean::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $disk = config('media-library.disk_name', 'public');
        $this->addMediaCollection('images')->useDisk($disk);
        $this->addMediaCollection('cover')->singleFile()->useDisk($disk);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (! config('media.conversions_enabled', true)) {
            return;
        }

        $this->addMediaConversion('thumb')
            ->width(800)->height(600)->format('webp')->quality(80)
            ->performOnCollections('images', 'cover');

        $this->addMediaConversion('large')
            ->width(1600)->height(1200)->format('webp')->quality(85)
            ->performOnCollections('images', 'cover');
    }

    public function scopeActive($query)
    {
        return $query->whereRaw('is_active IS TRUE')->orderBy('event_date', 'desc');
    }

    public function scopeFeatured($query)
    {
        return $query->whereRaw('is_featured IS TRUE')->whereRaw('is_active IS TRUE');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCoverUrl(string $conversion = 'thumb'): string
    {
        $media = $this->getFirstMedia('cover') ?? $this->getFirstMedia('images');
        if ($media) {
            return $media->getUrl(config('media.conversions_enabled', true) ? $conversion : '');
        }
        return asset('images/placeholder-product.svg');
    }

    public function getWhatsappMessage(): string
    {
        return WhatsappTemplate::render('portfolio', [
            'event_title' => $this->title,
            'event_type'  => $this->event_type,
            'location'    => $this->location,
        ]);
    }
}
