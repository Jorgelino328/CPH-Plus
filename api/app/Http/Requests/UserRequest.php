<?php
namespace App\Http\Requests;

use App\Http\Requests\Traits\Updatable;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use Updatable;

    public function rules(): array
    {
        return $this->handleUpdate([
            'name'     => 'required|string|min:5|max:50',
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ], toExclude: ['password']);
    }
}
