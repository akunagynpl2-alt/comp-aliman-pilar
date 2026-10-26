<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class DatabaseBoolean implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): bool
    {
        return in_array(strtolower((string) $value), ['1', 't', 'true', 'yes', 'on'], true);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value === null) {
            return null;
        }

        $boolean = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($boolean === null) {
            throw new InvalidArgumentException("The {$key} attribute must be a boolean.");
        }

        return $model->getConnection()->getDriverName() === 'pgsql'
            ? ($boolean ? 'true' : 'false')
            : $boolean;
    }
}
