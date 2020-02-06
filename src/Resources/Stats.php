<?php

namespace HCGCloud\Pterodactyl\Resources;

class Stats extends Resource
{
    /**
     * The cpu of the stats.
     *
     * @var array
     */
    public $cpu = [];

    /**
     * The disk of the stats.
     *
     * @var array
     */
    public $disk = [];

    /**
     * The memory of the stats.
     *
     * @var array
     */
    public $memory = [];

    /**
     * The state of the server.
     *
     * @var string
     */
    public $state;
}
