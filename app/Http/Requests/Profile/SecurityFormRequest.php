<?php

namespace App\Http\Requests\Profile;

use ActivismeBe\ValidationRules\Rules\MatchUserPassword;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SecurityFormRequest
 *
 * @package App\Http\Requests\Profile
 */
class SecurityFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', new MatchUserPassword($this->user())],
            'password'     => ['required', 'string', 'min:8', 'confirmed']
        ];
    }
}
