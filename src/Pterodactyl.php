<?php

namespace HCGCloud\Pterodactyl;

use GuzzleHttp\Client as HttpClient;

class Pterodactyl
{
    use MakesHttpRequests;
    use Actions\ManagesUsers;
    use Actions\ManagesServers;
    use Actions\ManagesAllocations;
    use Actions\UsesServers;
    use Actions\ManagesNodes;
    use Actions\ManagesNests;
    use Actions\ManagesEggs;
    use Actions\ManagesLocations;

    /**
     * The Pterodactyl API Key.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The Pterodactyl Base Uri.
     *
     * @var string
     */
    public $baseUri;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * Create a new Pterodactyl instance.
     *
     * @param string             $apiKey
     * @param \GuzzleHttp\Client $guzzle
     *
     * @return void
     */
    public function __construct($apiKey, $baseUri, HttpClient $guzzle = null)
    {
        $this->apiKey = $apiKey;

        $this->baseUri = $baseUri;

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri'    => $this->baseUri,
            'http_errors' => false,
            'headers'     => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Transform response data to resources.
     *
     * @param array $response
     *
     * @return mixed
     */
    protected function transform($response)
    {
        if (empty($response['object'])) {
            return $response;
        }

        switch ($response['object']) {
            case 'list':
                $data = array_map(function ($object) {
                    return $this->transform($object);
                }, $response['data']);

                if (isset($response['meta'])) {
                    return [
                        'data' => $data,
                        'meta' => $response['meta'],
                    ];
                }

                return $data;
        }

        if (isset($response['attributes']['relationships'])) {
            $response['attributes']['relationships'] = array_map(function ($object) {
                return $this->transform($object);
            }, $response['attributes']['relationships']);
        }

        $class = '\\HCGCloud\\Pterodactyl\\Resources\\'.ucwords($response['object']);

        $resource = class_exists($class) ? new $class($response['attributes'], $this) : $response['attributes'];

        return $resource;
    }

    /**
     * Transform include array to url parameter.
     *
     * @param array $includes
     *
     * @return string
     */
    protected function include($includes)
    {
        return empty($includes) ? '' : '?include='.implode(',', $includes);
    }

    /**
     * Set a new timeout.
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
}
