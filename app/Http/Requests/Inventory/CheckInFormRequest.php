<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CheckInFormRequest
 *
 * @package App\Http\Requests\Inventory
 */
class CheckInFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->can('checkin', $this->item);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'quantity' => ['required', 'integer'],
            'note'     => ['max:150'],
        ];
    }
}
