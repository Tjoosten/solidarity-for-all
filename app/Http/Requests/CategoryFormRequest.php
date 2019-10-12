<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryFormRequest
 *
 * @package App\Http\Requests
 */
class CategoryFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = ['name' => ['string', 'required', 'max:255', 'unique:categories']];

        if ($this->isMethod('UPDATE')) {
            $rules = ['name' => ['string', 'required', 'max:255', 'unique:categories,name,' . $this->category->id]];
        }

        return $rules;
    }
}
