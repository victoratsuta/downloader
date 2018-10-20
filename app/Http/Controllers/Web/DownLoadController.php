<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CorrectUrl;
use App\Service\Downloader;

class DownLoadController extends Controller
{
    private $downloader;

    public function index()
    {

        $report = Downloader::getReport();

        return view('index', compact('report'));

    }

    public function add(CorrectUrl $request)
    {
        $this->downloader = new Downloader();
        $this->downloader->setUrl($request->get('url'));
        $this->downloader->run();

        return redirect()->route('index');

    }
}
