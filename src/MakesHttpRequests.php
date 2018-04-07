<?php

namespace Fruitbytes\Pterodactyl;

use Psr\Http\Message\ResponseInterface;
use Fruitbytes\Pterodactyl\Exceptions\TimeoutException;
use Fruitbytes\Pterodactyl\Exceptions\NotFoundException;
use Fruitbytes\Pterodactyl\Exceptions\ValidationException;
use Fruitbytes\Pterodactyl\Exceptions\FailedActionException;

trait MakesHttpRequests
{
    /**
     * Make a GET request to Pterodactyl servers and return the response.
     *
     * @param  string $uri
     * @return mixed
     */
    private function get($uri)
    {
        return $this->request('GET', $uri);
    }

    /**
     * Make a POST request to Pterodactyl servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function post($uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make a PUT request to Pterodactyl servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function put($uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Make a DELETE request to Pterodactyl servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function delete($uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * Make request to Pterodactyl servers and return the response.
     *
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function request($verb, $uri, array $payload = [])
    {
        $url = $this->baseUri . $uri;

        $body = json_encode($payload);

        $hmac  = hash_hmac('sha256', $url . $body, $this->apiSecret, true);

        $token = $this->apiKey . '.' . base64_encode($hmac);

        $options['body'] = $body;
        $options = array_add($options, 'debug', true);
        $options['headers'] = array_add($options, 'Authorization', 'Bearer '.$token);

        $response = $this->guzzle->request($verb, $uri, $options);

        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 204) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @return void
     */
    private function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }

        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() == 400) {
            throw new FailedActionException((string) $response->getBody());
        }

        throw new \Exception((string) $response->getBody());
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param  integer $timeout
     * @param  callable $callback
     * @return mixed
     */
    public function retry($timeout, $callback)
    {
        $start = time();

        beginning:

        if ($output = $callback()) {
            return $output;
        }

        if (time() - $start < $timeout) {
            sleep(5);

            goto beginning;
        }

        throw new TimeoutException($output);
    }
}
