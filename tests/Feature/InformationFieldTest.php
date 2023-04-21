<?php

namespace Tests\Feature;

use App\Models\InformationField;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;

class InformationFieldTest extends TestCase
{
    // use WithoutMiddleware;

    public function test_anybody_can_see_information_fields_with_the_correct_information()
    {

        $this->seed();

        $this->json('get', 'api/fields')
        ->assertStatus(200)
        ->assertJson([
            [
                "id" => 1,
                "name" => "name",
                "value" => "JOSÉ CORTÉS",
            ],
            [
                "id" => 2,
                "name" => "introduction",
                "value" => "PROGRAMADOR WEB",
            ],
            [
                "id" => 3,
                "name" => "githubLink",
                "value" => "https://github.com/josecortesdev",
            ],
            [
                "id" => 4,
                "name" => "emailLink",
                "value" => "https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=josecortesdev@gmail.com&hl=es",
            ],
            [
                "id" => 5,
                "name" => "LinkedinLink",
                "value" => "https://www.linkedin.com/in/josecortesdev",
            ],
            [
                "id" => 6,
                "name" => "emailFooter",
                "value" => "josecortesdev@gmail.com",
            ],
        ]);
    }

    public function test_admin_can_update_an_information_field()
    {
        $this->seed();
        $field = InformationField::create(
            [
                "name" => "SocialMediaLinkTest",
                "value" => "https://www.socialmedia.com/josecortesdev",
            ]
        );

        $fieldUpdated = [
            "name" => "SocialMediaLinkTestUpdated",
            "value" => "https://www.socialmedia.com/josecortesdev/updated",
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('put', "api/fields/7", $fieldUpdated)
        ->assertStatus(200)
        ->assertJson(
            [
                "id" => 7,
                "name" => "SocialMediaLinkTestUpdated",
                "value" => "https://www.socialmedia.com/josecortesdev/updated",
            ]
        );
        
    }

    public function test_information_fields_table_has_basic_information()
    {
        $this->seed();
        $this->assertDatabaseHas('information_fields', [

                "id" => 1,
                "name" => "name",
                "value" => "JOSÉ CORTÉS",
    
                "id" => 2,
                "name" => "introduction",
                "value" => "PROGRAMADOR WEB",
     
                "id" => 3,
                "name" => "githubLink",
                "value" => "https://github.com/josecortesdev",

                "id" => 4,
                "name" => "emailLink",
                "value" => "https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=josecortesdev@gmail.com&hl=es",
     
                "id" => 5,
                "name" => "LinkedinLink",
                "value" => "https://www.linkedin.com/in/josecortesdev",

                "id" => 6,
                "name" => "emailFooter",
                "value" => "josecortesdev@gmail.com",

        ]);
    }
}
