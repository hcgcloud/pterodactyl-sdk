<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Allocation;
use HCGCloud\Pterodactyl\Resources\Server;
use HCGCloud\Pterodactyl\Resources\ServerDatabase;

trait ManagesServers
{
    /**
     * Get the collection of servers.
     *
     * @param int $page
     *
     * @return array
     */
    public function servers(int $page = 1)
    {
        $data = $this->get('api/application/servers?page='.$page);
        $transform = $this->transformCollection(
            $data['data'],
            Server::class
        );

        return [
            'data' => $transform,
            'meta' => $data['meta'],
        ];
    }

    /**
     * Get a server instance.
     *
     * @param int $serverId
     *
     * @return Server
     */
    public function server(int $serverId)
    {
        $request = $this->get("api/application/servers/$serverId".'?include=allocations');

        $allocations = $this->transformCollection(
            $request['attributes']['relationships']['allocations']['data'],
            Allocation::class
        );

        $server = new Server($request, $this);

        $server->allocations = $allocations;

        return $server;
    }

    /**
     * Get a server instance by external id.
     *
     * @param int $externalId
     *
     * @return Server
     */
    public function serverEx(int $externalId)
    {
        $request = $this->get("api/application/servers/external/$externalId".'?include=allocations');

        $allocations = $this->transformCollection(
            $request['attributes']['relationships']['allocations']['data'],
            Allocation::class
        );

        $server = new Server($request, $this);

        $server->allocations = $allocations;

        return $server;
    }

    /**
     * Create a new server.
     *
     * @param array $data
     *
     * @return Server
     */
    public function createServer(array $data)
    {
        return new Server($this->post('api/application/servers', $data), $this);
    }

    /**
     * Delete the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function deleteServer(int $serverId)
    {
        return $this->delete("api/application/servers/$serverId");
    }

    /**
     * Force delete the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function forceDeleteServer(int $serverId)
    {
        return $this->delete("api/application/servers/$serverId/force");
    }

    /**
     * Update details of the given server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return Server
     */
    public function updateServerDetails(int $serverId, array $data)
    {
        return new Server($this->patch("api/application/servers/$serverId/details", $data), $this);
    }

    /**
     * Update build configuration of the given server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return Server
     */
    public function updateServerBuild(int $serverId, array $data)
    {
        return new Server($this->patch("api/application/servers/$serverId/build", $data), $this);
    }

    /**
     * Update startup parameters of the given server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return Server
     */
    public function updateServerStartup(int $serverId, array $data)
    {
        return new Server($this->patch("api/application/servers/$serverId/startup", $data), $this);
    }

    /**
     * Suspend the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function suspendServer(int $serverId)
    {
        return $this->post("api/application/servers/$serverId/suspend");
    }

    /**
     * Unsuspend the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function unsuspendServer(int $serverId)
    {
        return $this->post("api/application/servers/$serverId/unsuspend");
    }

    /**
     * Reinstall the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function reinstallServer(int $serverId)
    {
        return $this->post("api/application/servers/$serverId/reinstall");
    }

    /**
     * Rebuild the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function rebuildServer(int $serverId)
    {
        return $this->post("api/application/servers/$serverId/rebuild");
    }

    /**
     * Get a collection of databases of a server.
     *
     * @param int $serverId
     *
     * @return ServerDatabase[]
     */
    public function serverDatabases(int $serverId)
    {
        $data = $this->get("api/application/servers/$serverId/databases");
        $transform = $this->transformCollection(
            $data['data'],
            ServerDatabase::class
        );

        return $transform;
    }

    /**
     * Get a database instance of a server.
     *
     * @param int $serverId
     * @param int $databaseId
     *
     * @return ServerDatabase
     */
    public function serverDatabase(int $serverId, int $databaseId)
    {
        return new ServerDatabase($this->get("api/application/servers/$serverId/databases/$databaseId"), $this);
    }

    /**
     * Create a database for a server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return ServerDatabase
     */
    public function createServerDatabase(int $serverId, array $data)
    {
        return new ServerDatabase($this->post("api/application/servers/$serverId/databases/", $data), $this);
    }

    /**
     * Reset the password of a server's database.
     *
     * @param int $serverId
     * @param int $databaseId
     *
     * @return void
     */
    public function resetServerDatabasePassword(int $serverId, int $databaseId)
    {
        return $this->post("api/application/servers/$serverId/databases/$databaseId/reset-password");
    }

    /**
     *  Delete the given database of a server.
     *
     * @param int $serverId
     * @param int $databaseId
     *
     * @return void
     */
    public function deleteServerDatabase(int $serverId, int $databaseId)
    {
        return $this->delete("api/application/servers/$serverId/databases/$databaseId");
    }
}
