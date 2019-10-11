<?php

namespace Sqits\Postcode\Services;

use sqits\postcode\Address;
use sqits\postcode\PostcodeClient;
use sqits\postcode\validators\AddressValidator;

class AddressService
{
    /**
     * @var \sqits\postcode\Validators\AddressValidator
     */
    protected $validator;

    /**
     * @var \sqits\postcode\PostcodeClient
     */
    protected $client;

    /**
     * AddressService constructor.
     *
     * @param  \sqits\postcode\Validators\AddressValidator  $validator
     * @param  \sqits\postcode\PostcodeClient  $client
     */
    public function __construct(AddressValidator $validator, PostcodeClient $client)
    {
        $this->validator = $validator;
        $this->client = $client;
    }

    /**
     * Search for the postcode.
     *
     * @param  string  $postcode
     * @param  int  $houseNumber
     * @param  string|null  $houseNumberAddition
     * @return \sqits\postcode\Address
     * @throws \Exception
     * @since 1.0.0
     * @author Milan Jansen <m.jansen@sqits.nl>
     */
    public function search(string $postcode, int $houseNumber, string $houseNumberAddition = null): Address
    {
        try {
            $this->validator->validate(array_filter(compact('postcode', 'houseNumber', 'houseNumberAddition')));

            $uri = $this->getUri($postcode, $houseNumber, $houseNumberAddition);
            $response = $this->client->get($uri);
            $data = json_decode($response->getBody()->getContents(), true);

            return new Address($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Returns the URI for the API request.
     *
     * @param  string  $postcode
     * @param  int  $houseNumber
     * @param  string|null  $houseNumberAddition
     * @return string
     * @author Milan Jansen <m.jansen@sqits.nl>
     * @since 1.0.0
     */
    public function getUri(string $postcode, int $houseNumber, string $houseNumberAddition = null): string
    {
        return "https://api.postcode.nl/rest/addresses/$postcode/$houseNumber/$houseNumberAddition";
    }
}
