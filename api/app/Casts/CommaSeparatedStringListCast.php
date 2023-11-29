<?php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CommaSeparatedStringListCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return is_null($value) ? null : explode(',', $value) ;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return is_array($value) ? implode(',', $value) : null;
    }
}
