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
        $transform = $this->transformCollection(
            $data['data'],
            Location::class
        );

        return [
            'data' => $transform,
            'meta' => $data['meta'],
        ];
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
        return new Location($this->get("api/application/locations/$locationId"), $this);
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
        return new Location($this->post('api/application/locations', $data), $this);
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
        return new Location($this->patch("api/application/locations/$locationId", $data), $this);
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
