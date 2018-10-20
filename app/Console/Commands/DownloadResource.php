<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Jobs\DownloadResource as DownloadResourceJob;

class DownloadResource extends Command
{

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

        DownloadResourceJob::dispatch($this->argument('url'));

        $this->info("Job in queue");

    }
}
