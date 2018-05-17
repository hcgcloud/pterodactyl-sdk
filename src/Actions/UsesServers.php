<?php

namespace Fruitbytes\Pterodactyl\Actions;

use Fruitbytes\Pterodactyl\Resources\Server;
use Fruitbytes\Pterodactyl\Resources\Stat;

trait UsesServers
{

    /**
     * Get the collection of servers for the authenticated user.
     *
     * @return Server[]
     */
    public function listServers()
    {
        return $this->transformCollection(
            $this->get('user')['data'],
            Server::class
        );
    }

    /**
     * Gets the details of a given server.
     *
     * @return Server[]
     */
    public function getServer($serverUuid)
    {
        $request = $this->get("user/server/$serverUuid" . "?include=stats");

        $stats = $this->transformCollection(
            $request['included'],
            Stat::class
        );

        $server = new Server($request['data'], $this);

        $server->stats = $stats;

        return $server;
    }

    /**
     * Toggle the power on a given server.
     *
     * @param  string $serverUuid
     * @return void
     */
    public function powerServer($serverUuid, $action)
    {
        return $this->post("user/server/$serverUuid/power", ['action'=>"$action"]);
    }

    /**
     * Send a command to a given server.
     *
     * @param  string $serverUuid
     * @return void
     */
    public function commandServer($serverUuid, $command)
    {
        return $this->post("user/server/$serverUuid/command", ['command'=>"$command"]);
    }
}
