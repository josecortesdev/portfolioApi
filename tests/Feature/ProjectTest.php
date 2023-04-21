<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_anybody_can_see_projects_with_the_correct_structure()
    {

        $this->seed();

        $this->json('get', 'api/projects')
        ->assertStatus(200)
        ->assertJsonStructure([
            [
                'id',
                'name', 
                'description',
                'url',
                'code',
                'showVideo',
                'explanationVideo',
                'video',
                'active',
                'technologies' => [
                    [
                        'id',
                        'name',
                        'color',
                        'pivot' => [
                            'project_id',
                            'technology_id',
                        ],
                    ]
                ]
            ],
        ])
        ->assertJson([
            [
                "active" => 1
            ]
        ]);
    }

    public function test_admin_creates_a_new_project()
    {

        $this->seed();

        $newProject = [
            "name" => "createTest",
            "description" => "createTest description",
            "url" => "https://createTest.com/2",
            "code" => "https://github.com/josecortesdev/createTest",
            "showVideo" => null,
            "explanationVideo" => null,
            "video" => null,
            "active" => 1,
            "technologies" => json_encode([4,5]),
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('post', "api/projects", $newProject)
        ->assertStatus(201)
        ->assertJson(
            [
                [
                    "name" => "createTest",
                    "description" => "createTest description",
                    "url" => "https://createTest.com/2",
                    "code" => "https://github.com/josecortesdev/createTest",
                    "showVideo" => null,
                    "explanationVideo" => null,
                    "video" => null,
                    "active" => 1,
                    "technologies" => [
                        [
                            "id" => 4, 
                            "name" => "PHP", 
                            "color" => "dark"
                        ], 
                        [
                            "id" => 5,
                            "name" => "LARAVEL: SOCIALITE Y CASHIER", 
                            "color" => "naranja"
                        ]
                    ], 
                ]
            ]);
    }

    public function test_admin_update_a_project()
    {
        $this->seed();
        $project = Project::create(
            [
                "name" => "updateTest1",
                "description" => "description1",
                "url" => "https://updateTest.com/1",
                "code" => "https://github.com/josecortesdev/updateTest",
                "showVideo" => null,
                "explanationVideo" => null,
                "video" => null,
                "active" => 1,
            ]
        );

        $project->technologies()->sync([2,3]);

        $projectUpdated = [
            "name" => "updateTest2",
            "description" => "description2",
            "url" => "https://updateTest.com/2",
            "code" => "https://github.com/josecortesdev/updateTest",
            "showVideo" => null,
            "explanationVideo" => null,
            "video" => null,
            "active" => 1,
            "technologies" => json_encode([4,5]),
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('put', "api/projects/2", $projectUpdated)
        ->assertStatus(200)
        ->assertJson(
            [                
                [
                    "id" => 2,
                    "name" => "updateTest2",
                    "description" => "description2",
                    "url" => "https://updateTest.com/2",
                    "code" => "https://github.com/josecortesdev/updateTest",
                    "showVideo" => null,
                    "explanationVideo" => null,
                    "video" => null,
                    "active" => 1,
                    "technologies" => [
                        [
                            "id" => 4, 
                            "name" => "PHP", 
                            "color" => "dark"
                        ], 
                        [
                            "id" => 5,
                            "name" => "LARAVEL: SOCIALITE Y CASHIER", 
                            "color" => "naranja"
                        ]
                    ],
                ]         
            ]
        );
    }

    public function test_database_has_one_project_with_the_technologies_one_and_three()
    {
        $this->seed();
        
        $this->assertDatabaseHas('projects', [
            'name' => 'MYKELT.COM (Noviembre, 2021)',
            'active' => 1
        ]);
        $this->assertDatabaseHas('project_technology', [
            'project_id' => 1,
            'technology_id' => 1
        ]);
        $this->assertDatabaseHas('project_technology', [
            'project_id' => 1,
            'technology_id' => 3
        ]);
    }
}
