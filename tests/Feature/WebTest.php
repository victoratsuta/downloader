<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WebTest extends TestCase
{
    use DatabaseTransactions;

    public function testStatus()
    {
        $response = $this->get(route('index'));

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testAddResource()
    {

        $response = $this->post(route('add'),
            [
                'url' => env('TEST_URL_FILE')
            ]
        );

        $this->assertEquals(302, $response->status());


    }


}
