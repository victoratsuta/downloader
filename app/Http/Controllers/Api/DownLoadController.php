<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CorrectUrlApi;
use App\Service\Downloader;

class DownLoadController extends Controller
{
    private $downloader;

    public function getList(){

        $report = Downloader::normalaizeReport(Downloader::getReport());

        return response()->json($report);

    }

    public function add(CorrectUrlApi $request)
    {

        $this->downloader = new Downloader();
        $this->downloader->setUrl($request->get('url'));
        $this->downloader->run();

        return response()->json([]);

    }

}
