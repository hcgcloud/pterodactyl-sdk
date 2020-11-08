<?php

namespace HCGCloud\Pterodactyl\Resources;

use ArrayAccess;
use JsonSerializable;
use Serializable;

class Collection extends Resource implements ArrayAccess, JsonSerializable, Serializable
{
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

    /**
     * Get meta data of resource.
     *
     * @return array
     */
    public function meta()
    {
        return $this->attributes['meta'];
    }

    public function all()
    {
        return $this->attributes['data'];
    }

    public function get($offset)
    {
        return $this->attributes['data'][$offset];
    }

    public function set($offset, $value)
    {
        $this->attributes['data'][$offset] = $value;
    }

    public function has($offset)
    {
        return isset($this->attributes['data'][$offset]);
    }

    public function forget($offset)
    {
        unset($this->attributes['data'][$offset]);
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
        return $this->attributes['data'];
    }

    public function serialize()
    {
        return serialize($this->attributes['data']);
    }

    public function unserialize($serialized)
    {
        return $this->attributes['data'] = unserialize($serialized);
    }
}
