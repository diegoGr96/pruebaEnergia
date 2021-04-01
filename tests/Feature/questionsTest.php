<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Routing\Exceptions;

use App\Http\Controllers\QuestionsController;

class questionsTest extends TestCase
{

    private $rulesQuestions = [
        'tagged' => 'required',
        'fromdate' => 'integer|gte:0',
        'todate' => 'integer|gte:0',
    ];
    /**
     * Test the wrong URL(404).
     *
     * @return void
     */
    public function test_call_wrong_url(){
        $response = $this->json('GET', 'http://localhost/pruebaEnergia/public/api/wrong');

        $response->assertStatus(404)
                 ->assertJsonStructure(['message']);
    }

    /**
     * Test wrong type of params.
     *
     * @return void
     */
    public function test_wrong_type_params(){
        $data = [
            'tagged' => 'abc',
            'fromdate' => 'wrong',
            'todate' => '1617408000',
        ];


        $validator = $this->app['validator']->make($data, $this->rulesQuestions);
        $this->assertFalse($validator->passes());
    }

    /**
     * Test correct type of params.
     *
     * @return void
     */
    public function test_correct_type_params(){
        $data = [
            'tagged' => 'abc',
            'fromdate' => '1617235200',
            'todate' => '1617408000',
        ];


        $validator = $this->app['validator']->make($data, $this->rulesQuestions);
        $this->assertTrue($validator->passes());
    }
}
