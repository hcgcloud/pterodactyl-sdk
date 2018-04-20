<?php

namespace Fruitbytes\Pterodactyl\Resources;

class Server extends Resource
{
    /**
     * The type of the server.
     *
     * @var string
     */
    public $type;

    /**
     * The id of the server.
     *
     * @var integer
     */
    public $id;

    /**
     * The uuid of the server.
     *
     * @var integer
     */
    public $uuid;

    /**
     * The short uuid of the server.
     *
     * @var string
     */
    public $uuidShort;

    /**
     * The node id of the server.
     *
     * @var string
     */
    public $nodeId;

    /**
     * The name of the server.
     *
     * @var string
     */
    public $name;

    /**
     * The description of the server.
     *
     * @var string
     */
    public $description;

    /**
     * The skip scripts setting of the server.
     *
     * @var bool
     */
    public $skipScripts;

    /**
     * The suspended status of the server.
     *
     * @var integer
     */
    public $suspended;

    /**
     * The owner id of the server.
     *
     * @var integer
     */
    public $ownerId;

    /**
     * The memory allocation of the server.
     *
     * @var integer
     */
    public $memory;

    /**
     * The swap allocation of the server.
     *
     * @var integer
     */
    public $swap;

    /**
     * The disk allocation of the server.
     *
     * @var integer
     */
    public $disk;

    /**
     * The io throlling of the server.
     *
     * @var integer
     */
    public $io;

    /**
     * The cpu limit of the server.
     *
     * @var integer
     */
    public $cpu;

    /**
     * The oom disabled setting of the server.
     *
     * @var integer
     */
    public $oomDisabled;

    /**
     * The ip allocation id of the server.
     *
     * @var integer
     */
    public $allocationId;

    /**
     * The service id for the server.
     *
     * @var integer
     */
    public $serviceId;

    /**
     * The option id for the server.
     *
     * @var integer
     */
    public $optionId;

    /**
     * The pack id for the server.
     *
     * @var integer
     */
    public $packId;

    /**
     * The statup script for the server.
     *
     * @var string
     */
    public $startup;

    /**
     * The docker image for the server.
     *
     * @var string
     */
    public $image;

    /**
     * The primary username for the server.
     *
     * @var string
     */
    public $username;

    /**
     * The installed status of the server.
     *
     * @var integer
     */
    public $installed;

    /**
     * The date/time the server was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the server was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * The attributes of the server.
     *
     * @var array
     */
    public $attributes = [];

    /**
     * The attributes of the server.
     *
     * @var array
     */
    public $allocations = [];

    /**
     * Delete the given server.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->deleteServer($this->id);
    }

    /**
     * Suspend the server.
     *
     * @return void
     */
    public function suspend()
    {
        return $this->pterodactyl->suspendServer($this->id);
    }

    /**
     * Unsuspend the server.
     *
     * @return void
     */
    public function unsuspend()
    {
        return $this->pterodactyl->unsuspendServer($this->id);
    }
}
