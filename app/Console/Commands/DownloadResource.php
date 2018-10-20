<?php

namespace App\Console\Commands;

use App\Service\Downloader;
use Illuminate\Console\Command;

class DownloadResource extends Command
{

    private $downloader;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:resource {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download resource';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->downloader = new Downloader();
        $this->downloader->setUrl($this->argument('url'));
        $this->downloader->run();

        $this->info("Job in queue");

    }
}
