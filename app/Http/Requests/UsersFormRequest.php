<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UsersFormRequest
 *
 * @package App\Http\Requests
 */
class UsersFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge($this->methodSpecificRules(), [
            'name'   => ['required', 'string', 'max:255'],
            'role'  => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * The method specific rules based on HTTP request method.
     *
     * @return array
     */
    private function methodSpecificRules(): array
    {
        if ($this->isMethod('PATCH')) {
            $user = $this->userEntity;
            return ['email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id]];
        }

        return [ 'email' => ['required', 'string', 'email', 'max:255', 'unique:users']];
    }
}
