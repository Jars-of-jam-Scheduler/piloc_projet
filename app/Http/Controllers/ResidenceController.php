<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidenceRequest;
use App\Http\Requests\UpdateResidenceRequest;
use App\Models\Residence;
use App\Http\Resources\ResidenceResource;

use Illuminate\Support\Facades\Gate;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
	 * 
	 * Admins can see all the residences
	 * Landlords can see only his own residences
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		Gate::authorize('is-admin-or-landlord');

		if(auth()->user()->hasRole('admin')) {
			$residences = Residence::withTrashed()->latest()->simplePaginate(10);
		} else {
			$residences = auth()->user()->residences()->latest()->simplePaginate(10);
		}

		return ResidenceResource::collection($residences);	
    }

	/**
	 * Admins can see any residence
	 * Landlords can see only his own residences
	 */
	public function getOne(Residence $residence)  // Important: the route must call `withTrashed` in its declaration in the routing file
    {
		Gate::authorize('get-one-residence');

		$user = auth()->user();

		abort_if(!$user->hasRole('admin') && $residence->trashed(), 400);  // Non-admins must not be able to see soft deleted residences
	
		return new ResidenceResource($residence);
    }

    /**
     * Store a newly created resource in storage.
	 * 
	 * Admins can create any residence (@todo allow an admin to attach and detach these residences to landlords - IMPORTANT: not asked in the technical assessment although)
	 * Landlords can create their own residence
     *
     * @param  \App\Http\Requests\StoreResidenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResidenceRequest $request)
    {
		$user = auth()->user();

		if($user->hasRole('landlord')) {
			return $user->residences()->create($request->validated());
		} else {
			return Residence::create($request->validated());
		}
    }

    /**
     * Update the specified resource in storage.
	 * 
	 * Admins can update any residence
	 * Landlords can update their own residence
     *
     * @param  \App\Http\Requests\UpdateResidenceRequest  $request
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResidenceRequest $request, Residence $residence)
    {
        $residence->fill($request->validated());
		$residence->update();
    }

    /**
     * Remove the specified resource from storage.
	 * 
	 * Admins can destroy any residence
	 * Landlords can destroy their own residences
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Residence $residence)
    {
		Gate::authorize('destroy-residence');
		$residence->delete();
    }
}
