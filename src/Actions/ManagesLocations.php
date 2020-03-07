<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Location;

trait ManagesLocations
{
    /**
     * Get a collection of locations.
     *
     * @param int $page
     *
     * @return array
     */
    public function locations(int $page = 1)
    {
        $data = $this->get('api/application/locations?page='.$page);
        return $this->transform($data);
    }

    /**
     * Get a location instance.
     *
     * @param int $locationId
     *
     * @return Location
     */
    public function location(int $locationId)
    {
        return $this->get("api/application/locations/$locationId");
    }

    /**
     * Create a new location.
     *
     * @param array $data
     *
     * @return Location
     */
    public function createLocation(array $data)
    {
        return $this->post('api/application/locations', $data);
    }

    /**
     * Update a specified location.
     *
     * @param int   $locationId
     * @param array $data
     *
     * @return Location
     */
    public function updateLocation(int $locationId, array $data)
    {
        return $this->patch("api/application/locations/$locationId", $data);
    }

    /**
     * Delete the given location.
     *
     * @param int $locationId
     *
     * @return void
     */
    public function deleteLocation(int $locationId)
    {
        return $this->delete("api/application/locations/$locationId");
    }
}
