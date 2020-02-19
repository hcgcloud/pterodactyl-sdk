<?php

namespace HCGCloud\Pterodactyl\Resources;

class Allocation extends Resource
{
    /**
     * The id of the allocation.
     *
     * @var int
     */
    public $id;

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
    public $alias;

    /**
     * The port of the allocation.
     *
     * @var int
     */
    public $port;

    /**
     * The assign status of the allocation.
     *
     * @var bool
     */
    public $assigned;
}
