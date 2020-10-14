<?php

namespace HCGCloud\Pterodactyl;

use GuzzleHttp\Client as Client;

use HCGCloud\Pterodactyl\Managers\LocationManager;

class Pterodactyl
{
    /**
     * The Pterodactyl base uri.
     *
     * @var string
     */
    public $baseUri;

    /**
     * The Pterodactyl API key.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The Http client.
     *
     * @var Http
     */
    public $http;
    
    /**
     * Location manager.
     *
     * @var LocationManager
     */
    public $locations;

    /**
     * Create a new Pterodactyl instance.
     *
     * @param string             $apiKey
     * @param \GuzzleHttp\Client $guzzle
     *
     * @return void
     */
    public function __construct($baseUri, $apiKey, Client $guzzle = null)
    {
        $this->baseUri = $baseUri;

        $this->apiKey = $apiKey;
    
        $this->http = new Http($this, $guzzle);

        $this->locations = new LocationManager($this);
    }
}
