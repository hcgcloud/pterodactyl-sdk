<?php

namespace Fruitbytes\Pterodactyl\Resources;

class Allocation extends Resource
{
    /**
     * The id of the allocation.
     *
     * @var integer
     */
    public $id;

    /**
     * The node id of the allocation.
     *
     * @var integer
     */
    public $nodeId;

    /**
     * The ip address of the allocation.
     *
     * @var string
     */
    public $ip;

    /**
     * The ip alias of the allocation.
     *
     * @var string
     */
    public $ipAlias;

    /**
     * The port of the allocation.
     *
     * @var integer
     */
    public $port;

    /**
     * The server id of the allocation.
     *
     * @var integer
     */
    public $serverId;

    /**
     * The date/time the allocation was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the allocation was updated.
     *
     * @var string
     */
    public $updatedAt;
}
