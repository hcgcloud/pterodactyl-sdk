<?php

namespace HCGCloud\Pterodactyl\Resources;

use HCGCloud\Pterodactyl\Pterodactyl;

class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * The Pterodactyl SDK instance.
     *
     * @var Pterodactyl
     */
    protected $pterodactyl;

    /**
     * Create a new resource instance.
     *
     * @param array       $attributes
     * @param Pterodactyl $pterodactyl
     *
     * @return void
     */
    public function __construct(array $attributes, $pterodactyl = null)
    {
        $attributes = isset($attributes['attributes'])
            ? array_merge($attributes, $attributes['attributes'])
            : $attributes;
        $this->attributes = $attributes;
        $this->pterodactyl = $pterodactyl;

        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    private function fill()
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
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
}
