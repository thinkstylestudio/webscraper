<?php


namespace App\Services;


use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WebClient
{

    public function fetch($url): Response
    {
        $url = rtrim($url,"/");
        return Http::get($url);
    }

}
