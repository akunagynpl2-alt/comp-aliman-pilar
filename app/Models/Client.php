<?php

namespace App\Models;

use App\Casts\DatabaseBoolean;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'logo_path', 'website', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => DatabaseBoolean::class];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->useDisk(config('media-library.disk_name', 'public'));
    }

    public function scopeActive($query)
    {
        return $query->whereRaw('is_active IS TRUE')->orderBy('sort_order');
    }
}
