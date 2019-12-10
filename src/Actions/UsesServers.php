<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Server;
use HCGCloud\Pterodactyl\Resources\Stats;

trait UsesServers
{

    /**
     * Get the collection of servers for the authenticated user.
     *
     * @return array
     */
    public function listServers(int $page = 1)
    {
        $data = $this->get("api/client?page=" . $page);
        $transform = $this->transformCollection(
            $data['data'],
            Server::class
        );
        return [
            'data' => $transform,
            'meta' => $data['meta']
        ];
    }

    /**
     * Gets the details of a given server.
     *
     * @return Server[]
     */
    public function getServer($serverIdentifier)
    {
        $request = $this->get("api/client/servers/$serverIdentifier");
        $server = new Server($request, $this);
        return $server;
    }

    /**
     * Toggle the power on a given server.
     *
     * @param  string $serverId
	 * @param  string $action
     * @return void
     */
    public function powerServer($serverIdentifier, $action)
    {
        return $this->post("api/client/servers/$serverIdentifier/power", ['signal'=>"$action"]);
    }

    /**
     * Send a command to a given server.
     *
     * @param  string $serverId
	 * @param  string $action
     * @return void
     */
    public function commandServer($serverIdentifier, $command)
    {
        return $this->post("api/client/servers/$serverIdentifier/command", ['command'=>"$command"]);
    }
    
    /**
     * Get the utilization of a given server.
     *
     * @param  string $serverId
     * @return Stats[]
     */
    public function utilizationServer($serverIdentifier)
    {
        $request = $this->get("api/client/servers/$serverIdentifier/utilization");
        $stats = new Stats($request, $this);
        return $stats;
    }
}
