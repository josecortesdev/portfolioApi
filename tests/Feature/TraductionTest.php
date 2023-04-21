<?php

namespace Tests\Feature;

use App\Http\Controllers\TraductionController;
use App\Http\Services\RapidTranslate;
use App\Models\Traduction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use App\Service;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TraductionTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_traduct_and_store_the_traduction()
    {
        $this->seed();

        // Lo mockeamos para evitar hacer llamadas a la API 
        $mock = Mockery::mock(TraductionController::class);
        $mock->shouldReceive('traduct')->with(['information' => 'Esta es la información que quiero traducir con la API'])->andReturn('This is the information I want to translate with the API');

        // $this->partialMock(TraductionController::class, function (MockInterface $mock) {
            
        //     $mock->shouldReceive('traduct')->with(['information' => 'Esta es la información que quiero traducir con la API'])->andReturn('This is the information I want to translate with the API');

        // });

        $InformationToTraduce = [
            "information" => "Esta es la información que quiero traducir con la API",
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('post', "api/traduction/traduct", $InformationToTraduce)
        ->assertStatus(201)
        ->assertJson(
            [
                "español" => "Esta es la información que quiero traducir con la API",
                "ingles" => "This is the information I want to translate with the API",  
            ]);

        $this->assertDatabaseHas('traductions', ['español' => 'Esta es la información que quiero traducir con la API']);
    }
    public function test_make_a_traduction()
    {
        $this->seed();

        $InformationToTraduce = [
            "information" => "Esta es la funcionalidad de traducir información",
        ];

        $admin = User::find(1);

        $this->actingAs($admin)->json('post', "api/traduction/onlytraduct", $InformationToTraduce)
        ->assertStatus(200)
        ->assertJson(
            [
                "information" => "This is the functionality of translating information",  
            ]);
    }

}
