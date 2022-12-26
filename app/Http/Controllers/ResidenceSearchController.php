<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchResidenceRequest;
use App\Models\Residence;
use App\Http\Resources\ResidenceResource;

class ResidenceSearchController extends Controller
{
    public function search(SearchResidenceRequest $request)
    {
		$validated = $request->validated();
        $status = $validated['status'];
        $zip_code = $validated['zip_code'];
        $city = $validated['city'];

        $query = auth()->user()->hasRole('admin') ? Residence::withTrashed()->query() : Residence::query();
        if ($status) {
            $query->where('status', $status);
        }
        if ($zip_code) {
            $query->where('zip_code', $zip_code);
        }
        if ($city) {
            $query->where('city', $city);
        }
        $residences = $query->get();  // @todo Use `orWhere` during query building

        return ResidenceResource::collection($residences);
    }
}
