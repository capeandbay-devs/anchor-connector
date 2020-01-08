<?php

namespace CapeAndBay\AnchorCMS\Library\Auth;

use CapeAndBay\AnchorCMS\Library\Feature;

class DockingPort extends Feature
{
    protected $url = '/admin-sso/v1';
    protected $user_uuid, $client_uuid;

    public function __construct()
    {
        parent::__construct();

        $this->setClientID(env('ANCHOR_CLIENT_ID', ''));
    }

    public function sso_url()
    {
        return $this->anchorCMS_client->public_url().$this->url;
    }

    public function setUserUUID($uuid)
    {
        $this->user_uuid = $uuid;
    }

    public function setClientID($uuid)
    {
        $this->client_uuid = $uuid;
    }

    public function confirmIdentity()
    {
        $results = false;

        $payload = [
            'user' => $this->user_uuid,
            'client' => $this->client_uuid
        ];

        $response = $this->anchorCMS_client->post($this->sso_url(), $payload);

        if($response)
        {
            $results = $response;
        }

        return $results;
    }

    public function disembark($to)
    {
        return redirect($to);
    }
}
