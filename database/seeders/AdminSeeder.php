<?php

namespace Database\Seeders;

use App\Models\{Role, User};

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::factory()
			->hasAttached([Role::findOrFail('admin')])
			->create([
				'password' => Hash::make('azerty'),
			]);
    }
}
