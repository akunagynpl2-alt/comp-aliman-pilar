<?php

namespace App\Models;

use App\Casts\DatabaseBoolean;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'client_name', 'client_title', 'event_type',
        'content', 'rating', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'rating'      => 'integer',
        'is_featured' => DatabaseBoolean::class,
        'is_active'   => DatabaseBoolean::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useDisk(config('media-library.disk_name', 'public'));
    }

    public function scopeActive($query)
    {
        return $query->whereRaw('is_active IS TRUE')->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->whereRaw('is_featured IS TRUE')->whereRaw('is_active IS TRUE');
    }
}
