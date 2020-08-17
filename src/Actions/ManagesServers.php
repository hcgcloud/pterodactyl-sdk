<?php

namespace HCGCloud\Pterodactyl\Actions;

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
        return $this->get('api/application/servers?page='.$page);
    }

    /**
     * Get a server instance.
     *
     * @param int   $serverId
     * @param array $includes
     *
     * @return Server
     */
    public function server(int $serverId, array $includes = ['allocations'])
    {
        return $this->get("api/application/servers/$serverId".$this->include($includes));
    }

    /**
     * Get a server instance by external id.
     *
     * @param string $externalId
     * @param array  $includes
     *
     * @return Server
     */
    public function serverEx(string $externalId, array $includes = ['allocations'])
    {
        return $this->get("api/application/servers/external/$externalId".$this->include($includes));
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
        return $this->post('api/application/servers', $data);
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
        return $this->patch("api/application/servers/$serverId/details", $data);
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
        return $this->patch("api/application/servers/$serverId/build", $data);
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
        return $this->patch("api/application/servers/$serverId/startup", $data);
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
        return $this->get("api/application/servers/$serverId/databases");
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
        return $this->get("api/application/servers/$serverId/databases/$databaseId");
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
        return $this->post("api/application/servers/$serverId/databases/", $data);
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
