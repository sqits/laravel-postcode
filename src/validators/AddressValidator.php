<?php

namespace Sqits\Postcode\Validators;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;

class AddressValidator
{
    /**
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * @var array
     */
    protected $rules = [
        'postcode' => ['required', 'regex:/^[1-9]{1}[0-9]{3}[A-Z]{2}$/'],
        'houseNumber' => ['required', 'integer', 'between:0,99999'],
        'houseNumberAddition' => ['sometimes', 'string']
    ];

    /**
     * AddressLookupValidator constructor.
     *
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validates the address lookup input.
     *
     * @param  array  $data
     * @throws \Illuminate\Validation\ValidationException
     * @author Milan Jansen <m.jansen@sqits.nl>
     * @since 1.0.0
     */
    public function validate(array $data = []): void
    {
        $validation = $this->validator->make($data, $this->rules);

        if ($validation->fails()) {
            throw new ValidationException($validation, new JsonResponse($validation->errors()));
        }
    }
}
