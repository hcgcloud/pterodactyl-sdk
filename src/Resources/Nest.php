<?php

namespace HCGCloud\Pterodactyl\Resources;

class Nest extends Resource
{
    /**
     * The id of the nest.
     *
     * @var integer
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
     * The attributes of the nest.
     *
     * @var array
     */
    public $attributes = [];
	
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

}
