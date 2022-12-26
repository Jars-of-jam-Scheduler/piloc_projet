<?php

namespace Database\Seeders;

use App\Models\{Role, User};

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LandlordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::factory()
			->count(20)
			->hasAttached([Role::findOrFail('landlord')])
			->create([
				'password' => Hash::make('azerty'),
			]);
    }
}
