<?php

namespace App\Console\Commands;

use App\Service\Downloader;
use App\Service\DownloadReportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class DownloadReport extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:report {limit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get report of current download jobs';

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
        $headers = ['Status', 'Url', 'Path'];

        $this->table($headers, Downloader::getReport($this->argument('limit')));
    }
}
