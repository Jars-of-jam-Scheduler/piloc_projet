<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
			'id' => $this->id,

			'name' => $this->label,

			'address' => [
				"street" => $this->street,
				"postcode" => $this->zipcode,
				"city" => $this->city,
				"latitude" => $this->lat,
				"longitude" => $this->lng
			],

			'surface' => $this->surface,
			'verbose_surface' => $this->surface . ' m2',

			'amount' => $this->monthly_price,
			'verbose_amount' => $this->surface . ' €',

			'status' => $this->status,

			'landlords' => $this->landlords
		];
    }
}
