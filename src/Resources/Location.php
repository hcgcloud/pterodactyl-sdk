<?php

namespace HCGCloud\Pterodactyl\Resources;

class Location extends Resource
{
    /**
     * The id of the location.
     *
     * @var int
     */
    public $id;

    /**
     * The short name of the location.
     *
     * @var string
     */
    public $short;

    /**
     * The long name of the location.
     *
     * @var string
     */
    public $long;

    /**
     * The date/time the location was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the location was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Delete the given location.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->deleteLocation($this->id);
    }

    /**
     * Update the given location.
     *
     * @return void
     */
    public function update(array $data = [])
    {
        $data = array_merge([
            'short' => $this->short,
            'long'  => $this->long,
        ], $data);

        return $this->pterodactyl->updateLocation($this->id, $data);
    }
}
