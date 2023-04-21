<?php

namespace Tests\Feature;

use App\Models\Technology;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TechonologyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_anybody_can_see_technologies_with_the_correct_structure()
    {

        $this->seed();

        $this->json('get', 'api/technologies')
        ->assertStatus(200)
        ->assertJsonStructure([
            [
                'id',
                'name', 
                'color',
            ],
        ]);
    }

    public function test_admin_creates_a_new_technology()
    {

        $this->seed();

        $newTechnology = [
            "name" => "VUE",
            "color" => "blue",
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('post', "api/technologies", $newTechnology)
        ->assertStatus(201)
        ->assertJson(
            [
                "name" => "VUE",
                "color" => "blue",  
            ]);
    }

    public function test_admin_can_update_technology()
    {
        $this->seed();
        $technology = Technology::create(
            [
                "name" => "VUE",
                "color" => "blue",
            ]
        );

        $technologyUpdated = [
            "name" => "VUE",
            "color" => "green",
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('put', "api/technologies/14", $technologyUpdated)
        ->assertStatus(200)
        ->assertJson(
            [
                "id" => 14,
                "name" => "VUE",
                "color" => "green",
            ]
        );
    }

    public function test_technologies_table_has_at_least_thirteen_registers()
    {
        $this->seed();

        $this->assertDatabaseCount('technologies', 13);
    }

}
