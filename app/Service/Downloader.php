<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.10.18
 * Time: 20:38
 */

namespace App\Service;


use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Imtigger\LaravelJobStatus\JobStatus;

class Downloader
{

    private $path = '/public/resources/';
    private $fileName;
    private $jobId;
    protected $url;

    public function __construct(string $url, int $jobId)
    {
        $this->url = $url;
        $this->jobId = $jobId;
    }

    public function download() : void
    {

        $contents = file_get_contents($this->url);
        $this->fileName = $this->path . substr($this->url, strrpos($this->url, '/') + 1);
        Storage::put($this->fileName, $contents);

    }

    public function saveReport() : void
    {

        Resource::create(
            [
                'url' => $this->url,
                'job_id' => $this->jobId

            ]
        );

    }

    public function updateReport() : void
    {

        Resource::where('job_id', $this->jobId)->update(
            [
                'path' => $this->fileName,

            ]
        );

    }

    static public function getReport(int $take): array
    {
        $report = [];

        foreach (JobStatus::take($take)->get() as $job){

            $resource = Resource::where('job_id', $job->id)->first();

            $jobReport =
                [
                    'status' => $job->status,
                    'url' => $resource->url
                ];

            if($job->is_finished){

                $jobReport['path'] = $resource->path;

            }

            $report[] = $jobReport;

        }

        return $report;
    }

}