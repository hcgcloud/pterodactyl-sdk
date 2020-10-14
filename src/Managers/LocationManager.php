<?php

namespace HCGCloud\Pterodactyl\Managers;

use HCGCloud\Pterodactyl\Resources\Location;

class LocationManager extends Manager
{
    /**
     * Get a collection of locations.
     *
     * @param int $page
     * @param array $query
     *
     * @return Collection
     */
    public function all(int $page = 1, array $query = [])
    {
        return $this->http->get('api/application/locations', array_merge([
            'page' => $page
        ], $query));
    }

    /**
     * Get a location instance.
     *
     * @param int   $locationId
     * @param array $includes
     *
     * @return Location
     */
    public function get(int $locationId, array $query = [])
    {
        return $this->http->get("api/application/locations/$locationId", $query);
    }

    /**
     * Create a new location.
     *
     * @param array $data
     *
     * @return Location
     */
    public function create(array $data)
    {
        return $this->http->post('api/application/locations', [], $data);
    }

    /**
     * Update a specified location.
     *
     * @param int   $locationId
     * @param array $data
     *
     * @return Location
     */
    public function update(int $locationId, array $data)
    {
        return $this->http->patch("api/application/locations/$locationId", [], $data);
    }

    /**
     * Delete the given location.
     *
     * @param int $locationId
     *
     * @return void
     */
    public function delete(int $locationId)
    {
        return $this->http->delete("api/application/locations/$locationId");
    }
}
