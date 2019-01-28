<?php

namespace HCGCloud\Pterodactyl\Resources;

class Stat extends Resource
{
    /**
     * The id of the stat.
     *
     * @var integer
     */
    public $id;

    /**
     * The status of the stat.
     *
     * @var integer
     */
    public $status;

    /**
     * The resources of the stat.
     *
     * @var array
     */
    public $resources = [];
}
