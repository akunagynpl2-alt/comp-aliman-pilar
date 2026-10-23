<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WhatsappTemplate
 *
 * @property int         $id
 * @property string      $key
 * @property string      $label
 * @property string      $template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class WhatsappTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'whatsapp_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'label',
        'template',
    ];

    // -------------------------------------------------------------------------
    // Static Helpers
    // -------------------------------------------------------------------------

    /**
     * Retrieve a template by its key and optionally replace {placeholder} tokens
     * with the values provided in the $replacements array.
     *
     * Example:
     *   WhatsappTemplate::getTemplate('order_confirm', [
     *       'name'       => 'Budi',
     *       'order_code' => 'ORD-001',
     *   ]);
     *
     * @param  string               $key
     * @param  array<string, mixed> $replacements
     * @return string
     */
    public static function getTemplate(string $key, array $replacements = []): string
    {
        $record = static::where('key', $key)->first();

        if (! $record) {
            return '';
        }

        $template = $record->template;

        foreach ($replacements as $placeholder => $value) {
            $template = str_replace('{' . $placeholder . '}', (string) $value, $template);
        }

        return $template;
    }

    public static function render(string $key, array $replacements = []): string
    {
        return static::getTemplate($key, $replacements);
    }
}
