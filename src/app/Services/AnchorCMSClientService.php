<?php

namespace CapeAndBay\AnchorCMS\Services;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;

class AnchorCMSClientService
{
    protected $root_url = 'https://anchor.capeandbay.com';
    protected $public_url = '/api';
    protected $client_id;

    public function __construct()
    {
        $this->client_id = config('anchor-cms.deets.client_uuid');
    }

    public function public_url()
    {
        return $this->root_url.$this->public_url;
    }

    public function get($endpoint)
    {
        $results = false;

        $url = $endpoint;
        $response = Curl::to($url)
            ->asJson(true)
            ->get();

        if($response)
        {
            Log::info('AnchorCMS Response from '.$url, $response);
            $results = $response;
        }
        else
        {
            Log::info('AnchorCMS Null Response from '.$url);
        }

        return $results;
    }
}
