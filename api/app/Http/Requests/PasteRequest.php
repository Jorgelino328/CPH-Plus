<?php
namespace App\Http\Requests;

use App\Http\Requests\Traits\Updatable;
use Illuminate\Foundation\Http\FormRequest;

class PasteRequest extends FormRequest
{
    use Updatable;

    protected function prepareForValidation()
    {
        $this->merge([
            'tags' => array_map(
                fn ($value) => str_replace(',', ' ', $value),
                $this->input('tags', [])
            )
        ]);
    }

    public function rules(): array
    {
        return $this->handleUpdate([
            'syntax_highlight_id' => 'nullable|exists:syntax_highlights',
            'seconds_to_expire'   => 'nullable|integer|min:600|max:31536000',
            'title'               => 'required|string',
            'tags'                => 'nullable|array',
            'tags.*'              => 'required|distinct|string|max:25',
            'content'             => 'required|string|max:500000',
            'listable'            => 'nullable|boolean',
            'password'            => 'nullable|string|min:8',
            'destroy_on_open'     => 'nullable|boolean'
        ]);
    }
}
