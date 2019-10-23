<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ItemFormRequest
 *
 * @package App\Http\Requests\Inventory
 */
class ItemFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'quantity'  => ['required', 'integer'],
            'location'  => ['required', 'integer'],
            'category'  => ['required', 'integer'],
        ];
    }
}
