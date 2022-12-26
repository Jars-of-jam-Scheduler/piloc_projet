<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterLandlordRequest;

use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function show()
    {
		return view('user.login');
    }

	public function login(Request $request)
    {
		$credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
		
        if (!auth()->attempt($credentials, true)) {
            return redirect(route('login'))->withErrors([
                'email' => 'Invalid email or password',
            ])->onlyInput('email');
        }

		$request->session()->regenerate();  // For security purposes, see https://owasp.org/www-community/attacks/Session_fixation
        return redirect()->intended();
    }

	public function register(RegisterLandlordRequest $request)
	{
        return User::create(['role' => 'landlord', ...$request->validated()]);
	}

	public function update(UpdateLandlordRequest $request)
	{
		$user = auth()->user();
        $user->fill($request->validated());
		$user->update();
	}

	public function getOne()
	{
		$user = auth()->user();
		return new UserResource($user);
	}
}