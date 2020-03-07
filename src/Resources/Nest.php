<?php

namespace HCGCloud\Pterodactyl\Resources;

class Nest extends Resource
{
    /**
     * The id of the nest.
     *
     * @var int
     */
    public $id;

    /**
     * The uuid of the nest.
     *
     * @var string
     */
    public $uuid;

    /**
     * The author of the nest.
     *
     * @var string
     */
    public $author;

    /**
     * The name of the nest.
     *
     * @var string
     */
    public $name;

    /**
     * The description of the nest.
     *
     * @var string
     */
    public $description;

    /**
     * The date/time the nest was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the nest was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Get a collection of eggs in the given nest.
     *
     * @return Egg[]
     */
    public function eggs()
    {
        return $this->pterodactyl->eggs($this->id);
    }

    /**
     * Get a egg instance in the given nest.
     *
     * @param int   $eggId
     * @param array $includes
     *
     * @return Egg
     */
    public function egg($eggId, array $includes = [])
    {
        return $this->pterodactyl->egg($this->id, $eggId, $includes);
    }
}
