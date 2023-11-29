<?php
namespace App\Http\Requests;

use App\Http\Requests\Traits\Updatable;
use Illuminate\Foundation\Http\FormRequest;

class PasteRequest extends FormRequest
{
    use Updatable;

    const TAG_SEPARATOR_ALTERNATIVE = '‚';

    public function rules(): array
    {
        return $this->handleUpdate([
            'syntax_highlight_id' => 'nullable|exists:syntax_highlights,id',
            'seconds_to_expire'   => 'nullable|integer|min:600|max:31536000',
            'title'               => 'required|string|max:50',
            'tags'                => 'nullable|array|max:10',
            'tags.*'              => 'required|distinct|string|max:25',
            'content'             => 'required|string|max:500000',
            'listable'            => 'nullable|boolean',
            'password'            => 'nullable|string|min:8',
            'destroy_on_open'     => 'nullable|boolean'
        ]);
    }

    protected function passedValidation()
    {
        $this->merge([
            'tags' => array_map(
                fn ($value) => str_replace(',', self::TAG_SEPARATOR_ALTERNATIVE, $value),
                $this->input('tags') ?? []
            )
        ]);
    }
}
