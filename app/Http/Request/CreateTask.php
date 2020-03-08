<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required',
            'priority' => 'required|numeric|min:1',
            'dueIn'    => 'required|numeric|min:1',
        ];
    }
}
