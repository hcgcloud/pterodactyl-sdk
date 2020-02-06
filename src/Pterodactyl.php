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
     * Transform the items of the collection to the given class.
     *
     * @param array  $collection
     * @param string $class
     * @param array  $extraData
     *
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
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
