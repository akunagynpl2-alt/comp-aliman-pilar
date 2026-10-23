<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Media
 *
 * Spatie-compatible media model for managing uploaded files and their conversions.
 *
 * @property int         $id
 * @property string      $model_type
 * @property int         $model_id
 * @property string|null $uuid
 * @property string      $collection_name
 * @property string      $name
 * @property string      $file_name
 * @property string|null $mime_type
 * @property string      $disk
 * @property string|null $conversions_disk
 * @property int         $size
 * @property array       $manipulations
 * @property array       $custom_properties
 * @property array       $generated_conversions
 * @property array       $responsive_images
 * @property int|null    $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Media extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'uuid',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'conversions_disk',
        'size',
        'manipulations',
        'custom_properties',
        'generated_conversions',
        'responsive_images',
        'order_column',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'manipulations'         => 'array',
        'custom_properties'     => 'array',
        'generated_conversions' => 'array',
        'responsive_images'     => 'array',
        'model_id'              => 'integer',
        'size'                  => 'integer',
        'order_column'          => 'integer',
    ];

    // -------------------------------------------------------------------------
    // Methods
    // -------------------------------------------------------------------------

    /**
     * Get the public URL to the original file.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return Storage::url("media/{$this->id}/{$this->file_name}");
    }

    /**
     * Get the public URL for a specific conversion.
     * Falls back to the original file URL if the conversion has not been generated.
     *
     * @param  string $conversion
     * @return string
     */
    public function getThumbnailUrl(string $conversion = 'thumbnail'): string
    {
        $generated = $this->generated_conversions ?? [];

        if (! empty($generated[$conversion])) {
            $extension  = pathinfo($this->file_name, PATHINFO_EXTENSION);
            $baseName   = pathinfo($this->file_name, PATHINFO_FILENAME);
            $convFile   = "{$baseName}-{$conversion}.{$extension}";

            return Storage::url("media/{$this->id}/conversions/{$convFile}");
        }

        return $this->getUrl();
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /**
     * Scope a query to only include media belonging to the given collection.
     *
     * @param  Builder $query
     * @param  string  $name
     * @return Builder
     */
    public function scopeInCollection(Builder $query, string $name): Builder
    {
        return $query->where('collection_name', $name);
    }
}
