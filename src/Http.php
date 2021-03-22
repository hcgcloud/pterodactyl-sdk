<?php

namespace HCGCloud\Pterodactyl;

use GuzzleHttp\Client;
use HCGCloud\Pterodactyl\Exceptions\AccessDeniedHttpException;
use HCGCloud\Pterodactyl\Exceptions\FailedActionException;
use HCGCloud\Pterodactyl\Exceptions\NotFoundException;
use HCGCloud\Pterodactyl\Exceptions\TimeoutException;
use HCGCloud\Pterodactyl\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

class Http
{
    /**
     * The Pterodactyl instance.
     *
     * @var Pterodactyl
     */
    protected $pterodactyl;

    /**
     * The Pterodactyl base uri.
     *
     * @var string
     */
    protected $baseUri;

    /**
     * The Pterodactyl API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Pterodactyl API key's type.
     *
     * @var string
     */
    protected $apiType;

    /**
     * The GuzzleHttp client.
     *
     * @var Client
     */
    protected $guzzle;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public $timeout = 30;

    public function __construct(Pterodactyl $pterodactyl, Client $guzzle = null)
    {
        $this->pterodactyl = $pterodactyl;

        $this->baseUri = $this->pterodactyl->baseUri;

        $this->apiKey = $this->pterodactyl->apiKey;

        $this->apiType = $this->pterodactyl->apiType;

        $this->guzzle = $guzzle ?: new Client([
            'base_uri'    => $this->baseUri,
            'http_errors' => false,
            'headers'     => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Make a GET request and return the response.
     *
     * @param string $uri
     *
     * @return mixed
     */
    public function get($uri, array $query = [])
    {
        return $this->request('GET', $uri, $query);
    }

    /**
     * Make a POST request and return the response.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $payload
     *
     * @return mixed
     */
    public function post($uri, array $query = [], array $payload = [])
    {
        return $this->request('POST', $uri, $query, $payload);
    }

    /**
     * Make a PUT request and return the response.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $payload
     *
     * @return mixed
     */
    public function put($uri, array $query = [], array $payload = [])
    {
        return $this->request('PUT', $uri, $query, $payload);
    }

    /**
     * Make a PATCH request and return the response.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $payload
     *
     * @return mixed
     */
    public function patch($uri, array $query = [], array $payload = [])
    {
        return $this->request('PATCH', $uri, $query, $payload);
    }

    /**
     * Make a DELETE request and return the response.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $payload
     *
     * @return mixed
     */
    public function delete($uri, array $query = [], array $payload = [])
    {
        return $this->request('DELETE', $uri, $query, $payload);
    }

    /**
     * Make request and return the response.
     *
     * @param string $method
     * @param string $uri
     * @param array  $query
     * @param array  $payload
     *
     * @return mixed
     */
    public function request($method, $uri, array $query = [], array $payload = [])
    {
        $uri = $this->baseUri.'/api/'.$this->apiType.'/'.$uri;

        $body = json_encode($payload);

        $token = $this->apiKey;

        $options['query'] = $query;
        $options['body'] = $body;
        $options['debug'] = false;
        $options['headers']['Authorization'] = 'Bearer '.$token;

        $response = $this->guzzle->request($method, $uri, $options);

        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 204 && $response->getStatusCode() != 201) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return $this->transform(json_decode($responseBody, true)) ?: $responseBody;
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
                $response['data'] = array_map(function ($object) {
                    return $this->transform($object);
                }, $response['data']);

                // Rename to use the collection resource.
                $response['object'] = 'collection';
            break;
        }

        if (isset($response['attributes']['relationships'])) {
            $response['attributes']['relationships'] = array_map(function ($object) {
                return $this->transform($object);
            }, $response['attributes']['relationships']);
        }

        $object = ucwords($this->camelCase($response['object']));

        $class = class_exists('\\HCGCloud\\Pterodactyl\\Resources\\'.$object) ?
            '\\HCGCloud\\Pterodactyl\\Resources\\'.$object :
            '\\HCGCloud\\Pterodactyl\\Resources\\'.$object;

        $resource = class_exists($class) ? new $class($response, $this->pterodactyl) : $response;

        return $resource;
    }

    /**
     * Convert the key name to camel case.
     *
     * @param $key
     */
    private function camelCase($key)
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return void
     */
    private function handleRequestError(ResponseInterface $response)
    {
        switch ($response->getStatusCode()) {
            case 400:
                throw new FailedActionException((string) $response->getBody());
            case 403:
                throw new AccessDeniedHttpException();
            case 404:
                throw new NotFoundException();
            case 422:
                throw new ValidationException(json_decode((string) $response->getBody(), true));
            default:
                throw new \Exception((string) $response->getBody());
        }
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param int      $timeout
     * @param callable $callback
     *
     * @return mixed
     */
    public function retry($timeout, $callback)
    {
        $start = time();

        beginning:

        $output = $callback();

        if ($output) {
            return $output;
        }

        if (time() - $start < $timeout) {
            sleep(5);

            goto beginning;
        }

        throw new TimeoutException($output);
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
