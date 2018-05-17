<?php

namespace Fruitbytes\Pterodactyl\Actions;

use Fruitbytes\Pterodactyl\Resources\Server;
use Fruitbytes\Pterodactyl\Resources\Allocation;

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
            $this->get('admin/servers')['data'],
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
        $request = $this->get("admin/servers/$serverId" . "?include=allocations");

        $allocations = $this->transformCollection(
            $request['included'],
            Allocation::class
        );

        $server = new Server($request['data'], $this);

        $server->allocations = $allocations;

        return $server;
    }

    /**
     * Create a new server.
     *
     * @param  array $data
     * @return Server
     */
    public function createServer(array $data)
    {
        return new Server($this->post('admin/servers', $data)['data'], $this);
    }

    /**
     * Delete the given server.
     *
     * @param  string $serverId
     * @return void
     */
    public function deleteServer($serverId)
    {
        return $this->delete("admin/servers/$serverId");
    }

    /**
     * Suspend the given server.
     *
     * @param  string $serverId
     * @return void
     */
    public function suspendServer($serverId)
    {
        return $this->patch("admin/servers/$serverId/suspend", ['action'=>'suspend']);
    }

    /**
     * Unsuspend the given server.
     *
     * @param  string $serverId
     * @return void
     */
    public function unsuspendServer($serverId)
    {
        return $this->patch("admin/servers/$serverId/suspend", ['action'=>'unsuspend']);
    }
}
