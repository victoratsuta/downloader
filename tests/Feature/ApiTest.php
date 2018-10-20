<?php

namespace Tests\Feature;

use App\Models\Resource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Imtigger\LaravelJobStatus\JobStatus;
use Tests\TestCase;

class ApiTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAvailable()
    {
        $response = $this->json('GET', '/api/list');

        $this->assertEquals(200, $response->status());


    }

    public function testAddResource()
    {
        $response = $this->json('POST', route('api.add'),
            [
                'url' => env('TEST_URL_FILE')
            ]
        );

        $this->assertEquals(200, $response->status());


    }

    public function testAddValidationErrorRequire()
    {
        $response = $this->json('POST', route('api.add'));

        $this->assertEquals(422, $response->status());

    }

    public function testAddValidationErrorUrl()
    {
        $response = $this->json('POST', route('api.add'),
            [
                'url' => 'wrong_url'
            ]
        );

        $this->assertEquals(422, $response->status());

    }

    public function testList()
    {

        $jobStatus = JobStatus::create(
            [
                'type' => 'App\Jobs\DownloadResource',
                'queue' => 'default',
                'attempts' => '0',
                'progress_now' => '100',
                'progress_max' => '100',
                'status' => 'finished',
            ]
        );

        $resource = Resource::create(
            [
                'job_status_id' => $jobStatus->id,
                'url' => env('TEST_URL_FILE'),
                'path' => env('TEST_STORAGE_FILE')
            ]
        );

        $response = $this->json('GET', route('api.list'));

        $response
            ->assertJson(
                [
                    [
                        'url' => $resource->url,
                        'path' => $resource->path,
                        'status' => 'finished'
                    ]
                ]
            );

    }



    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }
}
