<?php

namespace HCGCloud\Pterodactyl;

use HCGCloud\Pterodactyl\Exceptions\FailedActionException;
use HCGCloud\Pterodactyl\Exceptions\NotFoundException;
use HCGCloud\Pterodactyl\Exceptions\TimeoutException;
use HCGCloud\Pterodactyl\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

trait MakesHttpRequests
{
    /**
     * Make a GET request to Pterodactyl servers and return the response.
     *
     * @param string $uri
     *
     * @return mixed
     */
    private function get($uri)
    {
        return $this->request('GET', $uri);
    }

    /**
     * Make a POST request to Pterodactyl servers and return the response.
     *
     * @param string $uri
     * @param array  $payload
     *
     * @return mixed
     */
    private function post($uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make a PUT request to Pterodactyl servers and return the response.
     *
     * @param string $uri
     * @param array  $payload
     *
     * @return mixed
     */
    private function put($uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Make a PATCH request to Pterodactyl servers and return the response.
     *
     * @param string $uri
     * @param array  $payload
     *
     * @return mixed
     */
    private function patch($uri, array $payload = [])
    {
        return $this->request('PATCH', $uri, $payload);
    }

    /**
     * Make a DELETE request to Pterodactyl servers and return the response.
     *
     * @param string $uri
     * @param array  $payload
     *
     * @return mixed
     */
    private function delete($uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * Make request to Pterodactyl servers and return the response.
     *
     * @param string $verb
     * @param string $uri
     * @param array  $payload
     *
     * @return mixed
     */
    private function request($verb, $uri, array $payload = [])
    {
        $url = $this->baseUri.$uri;

        $body = json_encode($payload);

        $token = $this->apiKey;

        $options['body'] = $body;
        $options['debug'] = false;
        $options['headers']['Authorization'] = 'Bearer '.$token;

        $response = $this->guzzle->request($verb, $uri, $options);

        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 204 && $response->getStatusCode() != 201) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return $this->transform(json_decode($responseBody, true)) ?: $responseBody;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
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
}
