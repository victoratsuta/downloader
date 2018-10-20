<?php

namespace App\Jobs;

use App\Service\Downloader;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Imtigger\LaravelJobStatus\Trackable;

class DownloadResource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    public $tries = 3;

    protected $downloader;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->prepareStatus();
        $this->url = $url;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->downloader = new Downloader();
        $this->downloader->setUrl($this->url);
        $this->downloader->setJobStatusIdFromJobId($this->job->getJobId());
        $this->downloader->download();
        $this->downloader->addDownloadPathRoReport();

    }
}
