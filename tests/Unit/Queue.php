<?php

namespace Tests\Unit;

use App\Jobs\DownloadResource;
use Tests\TestCase;

class Queue extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testQueue()
    {
        Queue::fake();

        DownloadResource::dispatch(env('TEST_URL_FILE'));

        Queue::assertPushed(DownloadResource::class);

    }

}
