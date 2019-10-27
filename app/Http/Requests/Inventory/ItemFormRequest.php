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
        return array_merge($this->methodSpecificRules(), [
                'name'      => ['required', 'string', 'max:255'],
                'category'  => ['required', 'integer'],
            ]);
    }

    /**
     * Method for request method specific validation rules.
     *
     * @return array
     */
    private function methodSpecificRules(): array
    {
        if ($this->isMethod('POST')) {
            return ['quantity' => ['required', 'integer'], 'location' => ['required', 'integer']];
        }

        return [];
    }
}
