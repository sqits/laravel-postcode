<?php

namespace Sqits\Postcode;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Address implements Arrayable, Jsonable {
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Address constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Retrieve a property of the address.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return array_get($this->attributes, $key);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
