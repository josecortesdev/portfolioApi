<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_table_has_one_admin()
    {
        $this->seed();

        $this->assertDatabaseHas('users', [
            'name' => 'josecortesdev',
            'email' => 'josecortesdev@gmail.com',
            'role' => 1
        ]);
    }

    public function test_users_table_has_three_registers()
    {
        $this->seed();

        $this->assertDatabaseCount('users', 3);
    }

    public function test_model_user_exists()
    {
        $user = User::factory()->create();
 
        $this->assertModelExists($user);
    }
}
