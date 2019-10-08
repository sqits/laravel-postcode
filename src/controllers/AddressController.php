<?php

namespace sqits\postcode\src\controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use sqits\postcode\src\services\AddressService;

class AddressController extends Controller
{
    /**
     * @var \sqits\postcode\src\services\AddressService
     */
    protected $addressService;

    /**
     * AddressController constructor.
     *
     * @param  \sqits\postcode\src\services\AddressService  $addressService
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Show a postcode resource.
     *
     * @param  string  $postcode
     * @param  string  $houseNumber
     * @param  string|null  $houseNumberAddition
     * @return \Illuminate\Http\JsonResponse
     * @author Milan Jansen <m.jansen@sqits.nl>
     * @since 1.0.0
     */
    public function show(string $postcode, string $houseNumber, string $houseNumberAddition = null): JsonResponse
    {
        try {
            $address = $this->addressService->search(str_replace(' ', '', $postcode), (int)$houseNumber, $houseNumberAddition);
            return response()->json($address);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }
}
