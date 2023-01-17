<?php

namespace App\Http\Requests;

use App\Models\Support;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSupportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Support $support)
    {
        return [
            'title' => ['required', 'min:10', 'max:255'],
            'lesson' => ['required', 'string', 'exists:lessons,id'],
            'description' => ['required', 'string', 'min:10', 'max:10000'],
            'status' => ['required', Rule::in(array_keys($support->statusOptions))]
        ];
    }

}
