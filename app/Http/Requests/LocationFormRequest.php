<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LocationFormRequest
 *
 * @package App\Http\Requests
 */
class LocationFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'coordinator'   => ['required', 'numeric'],
            'address'       => ['required', 'string', 'max:255'],
            'postal'        => ['required', 'numeric', 'max:10000'],
            'city'          => ['required', 'string', 'max:255'],
        ];
    }
}
