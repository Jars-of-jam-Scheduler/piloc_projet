<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResidenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('is-admin-or-landlord');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
			'label' => 'required|string',
			'street' => 'required|string',
			'city' => 'required|string', 
			'zipcode' => 'required|string', 
			'lng' => 'required|numeric', 
			'lat' => 'required|numeric', 
			'surface' => 'required|decimal:2',
			'monthly_price' => 'required|decimal:2', 
			'status' => 'required|in:rented,available',
        ];
    }
}
