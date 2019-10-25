<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CheckInFormRequest
 *
 * @todo Rename Form request class because this is used by the checkin and checkout
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
        $criteria = ['required', 'integer', 'min:1'];

        if (request()->is('uitboeken/*')) {
            $criteria = ['required', 'integer', 'min:1', 'max:' . $this->item->quantity];
        }

        return [
            'quantity' => $criteria,
            'note'     => ['max:150'],
        ];
    }
}
