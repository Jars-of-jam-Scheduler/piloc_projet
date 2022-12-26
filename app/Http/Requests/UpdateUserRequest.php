<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('is-admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
			'name' => 'required|string', 
			'firstname' => 'required|string', 
			'email' => 'required|unique:users,email|email', 
			'password' => 'required|string',
			
			'roles' => 'required|array|min:1',
			'roles.*' => 'string|in:admin,landlord',
        ];
    }
}
