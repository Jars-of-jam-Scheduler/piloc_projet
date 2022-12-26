<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{AuthController, UserController, ResidenceController, ResidenceSearchController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
	Route::apiResource('users', UserController::class);
	Route::apiResource('residences', ResidenceController::class);

	Route::get('/user', [AuthController::class, 'getOne']);
	Route::put('/user', [AuthController::class, 'update']);

	Route::post('/seach_for_residences', [ResidenceSearchController::class, 'search']);

	// @todo UserController's method of: Route::put('/user/residences/{residence_id}/attach', [UserController::class, 'attachResidence'])->whereNumber('residence_id')->name('attach_residence');
	// @todo UserController's method of: Route::put('/user/residences/{residence_id}/detach', [UserController::class, 'detachResidence'])->whereNumber('residence_id')->name('detach_residence');
});

Route::post('/register', [AuthController::class, 'register'])->name('register_landlord');