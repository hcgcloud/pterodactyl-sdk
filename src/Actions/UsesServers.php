<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Server;
use HCGCloud\Pterodactyl\Resources\Stats;

trait UsesServers
{
    /**
     * Get the collection of servers for the authenticated user.
     *
     * @param int $page
     *
     * @return array
     */
    public function listServers(int $page = 1)
    {
        return $this->get('api/client?page='.$page);
    }

    /**
     * Gets the details of a given server.
     *
     * @param string $serverIdentifier
     * @param array  $includes
     *
     * @return Server[]
     */
    public function getServer(string $serverIdentifier, array $includes = [])
    {
        return $this->get("api/client/servers/$serverIdentifier".$this->include($includes));
    }

    /**
     * Toggle the power on a given server.
     *
     * @param string $serverIdentifier
     * @param string $action
     *
     * @return void
     */
    public function powerServer(string $serverIdentifier, string $action)
    {
        return $this->post("api/client/servers/$serverIdentifier/power", ['signal'=>"$action"]);
    }

    /**
     * Send a command to a given server.
     *
     * @param string $serverIdentifier
     * @param string $command
     *
     * @return void
     */
    public function commandServer(string $serverIdentifier, string $command)
    {
        return $this->post("api/client/servers/$serverIdentifier/command", ['command'=>"$command"]);
    }

    /**
     * Get the utilization of a given server.
     *
     * @param string $serverIdentifier
     *
     * @return Stats[]
     */
    public function utilizationServer(string $serverIdentifier)
    {
        return $this->get("api/client/servers/$serverIdentifier/utilization");
    }
}
