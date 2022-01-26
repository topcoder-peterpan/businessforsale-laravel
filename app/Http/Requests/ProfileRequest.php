<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = auth()->id();

        if (request()->isPasswordChange) {
            return [
                'name' => "required",
                'email' => "required|unique:super_admins,email,$id",
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        } else {
            return [
                'name' => "required",
                'email' => "required|unique:super_admins,email,$id",
            ];
        }
    }
}
