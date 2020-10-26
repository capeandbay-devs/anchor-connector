<?php

namespace CapeAndBay\AnchorCMS\app\Library;

use CapeAndBay\AnchorCMS\Services\AnchorCMSClientService;

class Feature
{
    public $anchorCMS_client;

    public function __construct()
    {
        $this->anchorCMS_client = new AnchorCMSClientService();
    }

    /**
     * Returns all whatever from the AllCommerce API
     * @return array
     */
    public function get()
    {
        $results = [];

        // Leave it for a child to use, right?

        return $results;
    }

    public function clients_uri()
    {
        return '/clients/'.config('anchor-cms.deets.client_uuid');
    }

    public function setIfExists($key, $arr = [])
    {
        $results = '';

        if(array_key_exists($key, $arr))
        {
            $results = $arr[$key];
        }

        return $results;
    }
}
