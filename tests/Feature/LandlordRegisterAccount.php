<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandlordRegisterAccount extends TestCase
{
	use RefreshDatabase;

    public function test_status() : void
    {
		$landlord = [
			'name' => 'The',
			'firstname' => 'Landlord',
			'email' => 'test@test.test', 
			'password' => 'azerty', 
		];

        $response = $this->post(route('register_landlord'), $landlord);
        $response->assertStatus(201);
    }
}
