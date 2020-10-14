<?php

namespace HCGCloud\Pterodactyl\Managers;

use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Http;

class Manager
{
    /**
     * The Pterodactyl instance.
     *
     * @var Pterodactyl
     */
    public $pterodactyl;

    /**
     * The Http client.
     *
     * @var Http
     */
    public $http;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;

        $this->http = $this->pterodactyl->http;
    }
}
