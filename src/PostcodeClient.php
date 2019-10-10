<?php

namespace Sqits\Postcode;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Config\Repository;

class PostcodeClient
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var PostcodeClient
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param Repository $config
     * @param PostcodeClient $client
     */
    public function __construct(Repository $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * Performs a GET request compatible with Postcode.nl.
     *
     * @param  string  $uri
     * @return mixed
     * @throws \Exception
     */
    public function get(string $uri)
    {
        try {
            return $this->client->get($uri, $this->getRequestOptions());
        } catch (ClientException $e) {
            $this->handleClientException($e);
        }
    }

    /**
     * Returns the configured request options.
     *
     * @return array
     */
    protected function getRequestOptions(): array
    {
        return $this->config->get('address.requestOptions');
    }

    /**
     * Handles the Guzzle client exception.
     *
     * @param  ClientException  $e
     * @throws \Exception
     */
    protected function handleClientException(ClientException $e): void
    {
        switch ($e->getCode()) {
            case 401:
                throw new \Exception('Unauthorized', 401);
            case 403:
                throw new \Exception('Account suspended.', 403);
            case 404:
                throw new \Exception('Address not found.', 404);
            default:
                throw new \Exception('An error has been found.', $e->getCode());
        }
    }
}
