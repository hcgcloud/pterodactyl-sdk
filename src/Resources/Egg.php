<?php

namespace HCGCloud\Pterodactyl\Resources;

class Egg extends Resource
{
    /**
     * The id of the egg.
     *
     * @var int
     */
    public $id;

    /**
     * The uuid of the egg.
     *
     * @var string
     */
    public $uuid;

    /**
     * The nest of the egg.
     *
     * @var int
     */
    public $nest;

    /**
     * The author of the egg.
     *
     * @var string
     */
    public $author;

    /**
     * The description of the egg.
     *
     * @var string
     */
    public $description;

    /**
     * The docker image url of the egg.
     *
     * @var string
     */
    public $dockerImage;

    /**
     * The config of the egg.
     *
     * @var array
     */
    public $config = [];

    /**
     * The startup of the egg.
     *
     * @var string
     */
    public $startup;

    /**
     * The script of the egg.
     *
     * @var array
     */
    public $script = [];

    /**
     * The date/time the egg was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the egg was updated.
     *
     * @var string
     */
    public $updatedAt;
}
