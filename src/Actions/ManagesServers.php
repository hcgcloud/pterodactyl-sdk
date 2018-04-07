<?php

namespace Fruitbytes\Pterodactyl\Actions;

use Fruitbytes\Pterodactyl\Resources\Server;

trait ManagesServers
{

    /**
     * Get the collection of servers.
     *
     * @return Server[]
     */
    public function servers()
    {
        return $this->transformCollection(
            $this->get('servers')['data'],
            Server::class
        );
    }

    /**
     * Get a server instance.
     *
     * @param  string $serverId
     * @return Server
     */
    public function server($serverId)
    {
        return new Server($this->get("servers/$serverId")['data'], $this);
    }

    /**
     * Create a new server.
     *
     * @param  array $data
     * @return Server
     */
    public function createServer(array $data)
    {
        return new Server($this->post('servers', $data)['data'], $this);
    }

    /**
     * Delete the given server.
     *
     * @param  string $serverId
     * @return void
     */
    public function deleteServer($serverId)
    {
        return $this->delete("servers/$serverId");
    }

    /**
     * Suspend the given server.
     *
     * @param  string $serverId
     * @return void
     */
    public function suspendServer($serverId)
    {
        return $this->patch("servers/$serverId/suspend", ['action'=>'suspend']);
    }

    /**
     * Unsuspend the given server.
     *
     * @param  string $serverId
     * @return void
     */
    public function unsuspendServer($serverId)
    {
        return $this->patch("servers/$serverId/suspend", ['action'=>'unsuspend']);
    }
}
