<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\SiteSetting
 *
 * @property int         $id
 * @property string      $key
 * @property string|null $value
 * @property string|null $group
 * @property string|null $type
 * @property string|null $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class SiteSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'label',
    ];

    // -------------------------------------------------------------------------
    // Static Helpers
    // -------------------------------------------------------------------------

    /**
     * Get a setting value by key, with an optional default.
     * Result is cached for 60 minutes under the 'settings' cache tag.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public static function get(string $key, $default = null): mixed
    {
        return Cache::remember(
            "site_setting:{$key}",
            now()->addMinutes(60),
            function () use ($key, $default) {
                $setting = static::where('key', $key)->first();

                return $setting ? $setting->value : $default;
            }
        );
    }

    /**
     * Set (update or insert) a setting value by key and flush the 'settings' cache tag.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget("site_setting:{$key}");
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /**
     * Scope a query to only include settings of a given group.
     *
     * @param  Builder $query
     * @param  string  $group
     * @return Builder
     */
    public function scopeByGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }
}
