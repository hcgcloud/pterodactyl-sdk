<?php

namespace HCGCloud\Pterodactyl\Resources;

class Allocation extends Resource
{
    /**
     * The id of the allocation.
     *
     * @var integer
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
     * @var integer
     */
    public $port;

    /**
     * The assign status of the allocation.
     *
     * @var boolean
     */
    public $assigned;
}
