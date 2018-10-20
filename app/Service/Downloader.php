<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 19.10.18
 * Time: 20:38
 */

namespace App\Service;


use App\Jobs\DownloadResource;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Imtigger\LaravelJobStatus\JobStatus;

class Downloader
{

    private $path = '/public/resources/';
    private $publicPath = '/storage/resources/';
    private $fileName;
    private $jobStatusId;
    protected $url;

    public function run(): void
    {

        $job = new DownloadResource($this->url);
        dispatch($job);

        $this->jobStatusId = $job->getJobStatusId();

        $this->saveReport();

    }

    public function download(): void
    {

        $contents = file_get_contents($this->url);
        $fileName = $this->path . substr($this->url, strrpos($this->url, '/') + 1);
        $this->fileName = $this->publicPath . substr($this->url, strrpos($this->url, '/') + 1);
        Storage::put($fileName, $contents);

    }


    public function setUrl($url): void
    {

        $this->url = $url;

    }

    public function setJobStatusIdFromJobId($jobId): void
    {

        $this->jobStatusId = JobStatus::where('job_id', $jobId)->first()->id;

    }

    public function saveReport(): void
    {

        Resource::create(
            [
                'url' => $this->url,
                'job_status_id' => $this->jobStatusId

            ]
        );

    }

    public function addDownloadPathRoReport(): void
    {

        Resource::where('job_status_id', $this->jobStatusId)->update(
            [
                'path' => $this->fileName,

            ]
        );

    }

    static public function getReport(int $take = 0): object
    {

        if ($take === 0) {

            $resources = Resource::paginate();

        } else {

            $resources = Resource::take($take)->get();

        }

        foreach ($resources as &$resource) {

            $job = JobStatus::find($resource->job_status_id);

            $resource->status = $job->status;

        }

        return $resources;

    }

    static public function normalaizeReport(object $report): object
    {
        return $report->map(function ($report) {
            return collect($report->toArray())
                ->only(['status', 'url', 'path'])
                ->all();
        });

    }

}