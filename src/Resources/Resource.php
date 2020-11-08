<?php

namespace HCGCloud\Pterodactyl\Resources;

use ArrayAccess;
use HCGCloud\Pterodactyl\Pterodactyl;
use JsonSerializable;
use Serializable;

class Resource implements ArrayAccess, JsonSerializable, Serializable
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * The origin attributes.
     *
     * @var array
     */
    protected $origin;

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
            ? $attributes['attributes']
            : $attributes;

        $this->origin = $this->attributes = $attributes;

        $this->pterodactyl = $pterodactyl;
    }

    public function getChangedData()
    {
        $data = array_diff($this->attributes, $this->origin);

        $this->origin = $this->attributes;

        return $data;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __get($key)
    {
        return $this->attributes[$key];
    }

    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }

    /**
     * Convert resource to array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->all();
    }

    public function all()
    {
        return $this->attributes;
    }

    public function get($offset)
    {
        return $this->attributes[$offset];
    }

    public function set($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    public function has($offset)
    {
        return isset($this->attributes[$offset]);
    }

    public function forget($offset)
    {
        unset($this->attributes[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->get($offset) : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $this->forget($offset);
        }
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function jsonSerialize()
    {
        return $this->attributes;
    }

    public function serialize()
    {
        return serialize($this->attributes);
    }

    public function unserialize($serialized)
    {
        return $this->attributes = unserialize($serialized);
    }
}
