<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $password = $this->faker->password;

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        $this->post('/api/v1/users', $data)
            ->assertStatus(201)
            ->assertJson(['data' => 'User created with success!']);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function test_can_update_user()
    {
        $user = factory(User::class)->create();

        $newName = $this->faker->name;

        $data = [
            'name' => $newName
        ];

        $this->put('/api/v1/users/' . $user->id, $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => $newName,
        ]);
    }

    public function test_can_delete_user()
    {
        $user = factory(User::class)->create();

        $this->delete('/api/v1/users/' . $user->id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }

    public function test_can_show_user()
    {
        $user = factory(User::class)->create();

        $this->get('/api/v1/users/' . $user->id)
            ->assertStatus(200)
            ->assertJson(['data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]]);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }
}
