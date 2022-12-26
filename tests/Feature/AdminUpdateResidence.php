<?php

namespace Tests\Feature;

use App\Models\{User, Role, Residence};

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;

class AdminUpdateResidence extends TestCase
{
	use RefreshDatabase;

	private array $admin;
	private Residence $residence;

	public function setUp() : void
	{
		parent::setUp();

		Role::create([  // Could use the Factory instead
			'title' => 'admin'
		]);
		Role::create([  // Could use the Factory instead
			'title' => 'landlord'
		]);

		$this->admin = User::create([  // Could use the Factory instead
			'name' => 'The',
			'firstname' => 'Admin',
			'email' => 'test@test.test', 
			'password' => 'azerty', 
		]);
		$this->admin->roles()->save(Role::findOrFail('admin'));
		Passport::actingAs($this->admin, ['*']);
	}

	public function test_status() : void
    {
		$residence = Residence::factory()->create();
		$residence_new_data = [
			'street' => 'My Super New Street'
		];

        $response = $this->put(route('residences.update', ['residence' => $residence->getKey()]), $residence_new_data);
        $response->assertStatus(200)
					->assertDatabaseHas('residences', [...$residence->toArray(), ...$residence_new_data]);
    }

	public function test_with_residence_id() : void
    {
		$residence = Residence::factory()->create();
		$residence_new_data = [
			'id' => 999
		];

        $response = $this->put(route('residences.update', ['residence' => $residence->getKey()]), $residence_new_data);
        $response->assertSessionHasErrors(['id']);
    }
}
