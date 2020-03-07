<?php

namespace HCGCloud\Pterodactyl\Resources;

class SubUser extends Resource
{
    /**
     * The id of the user.
     *
     * @var int
     */
    public $id;

    /**
     * The user id of the user.
     *
     * @var int
     */
    public $userId;

    /**
     * The server id of the user.
     *
     * @var int
     */
    public $serverId;

    /**
     * The permission of the user.
     *
     * @var array
     */
    public $permissions;

    /**
     * The date/time the user was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the user was updated.
     *
     * @var string
     */
    public $updatedAt;
}
