<?php
namespace App\Http\Requests\Traits;

trait Updatable
{
    public function handleUpdate(array $rules, array $toExclude = []): array
    {
        if ($this->isMethod('PUT') || $this->isMethod('PATCH'))
        {
            $formatter = function ($param, $rule) use ($toExclude)
            {
                return array_key_exists($param, $toExclude)
                    ? "exclude"
                    : str_replace("required|", "", $rule);
            };

            return array_map($formatter, array_keys($rules), array_values($rules));
        }

        return $rules;
    }
}
