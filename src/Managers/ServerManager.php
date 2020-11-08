<?php

namespace HCGCloud\Pterodactyl\Managers;

use HCGCloud\Pterodactyl\Managers\Manager;

use HCGCloud\Pterodactyl\Resources\Collection;

use HCGCloud\Pterodactyl\Resources\Server;

class ServerManager extends Manager
{
    /**
     * Get a paginated collection of servers.
     *
     * @param int $page
     * @param array $query
     *
     * @return Collection
     */
    public function paginate(int $page = 1, array $query = [])
    {
        return $this->http->get('servers', array_merge([
            'page' => $page
        ], $query));
    }

    /**
     * Get a server instance by id.
     *
     * @param int   $serverId
     * @param array $query
     *
     * @return Server
     */
    public function get(int $serverId, array $query = [])
    {
        return $this->http->get("servers/$serverId", $query);
    }

    /**
     * Get a server instance by external id.
     *
     * @param int   $externalId
     * @param array $query
     *
     * @return Server
     */
    public function getByExternalId(int $externalId, array $query = [])
    {
        return $this->http->get("servers/external/$externalId", $query);
    }

    /**
     * Create a new server.
     *
     * @param array $data
     *
     * @return Server
     */
    public function create(array $data)
    {
        return $this->http->post('server', [], $data);
    }

    /**
     * Update details of a specified server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return void
     */
    public function updateDetails(int $serverId, array $data)
    {
        return $this->http->patch("servers/$serverId/details", [], $data);
    }
    
    /**
     * Update build of a specified server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return void
     */
    public function updateBuild(int $serverId, array $data)
    {
        return $this->http->patch("servers/$serverId/build", [], $data);
    }

    /**
     * Update startup of a specified server.
     *
     * @param int   $serverId
     * @param array $data
     *
     * @return void
     */
    public function updateStartup(int $serverId, array $data)
    {
        return $this->http->patch("servers/$serverId/startup", [], $data);
    }

    /**
     * Suspend a specified server.
     *
     * @param int   $serverId
     *
     * @return void
     */
    public function suspend(int $serverId)
    {
        return $this->http->post("servers/$serverId/suspend");
    }

    /**
     * Unsuspend a specified server.
     *
     * @param int   $serverId
     *
     * @return void
     */
    public function unsuspend(int $serverId)
    {
        return $this->http->post("servers/$serverId/unsuspend");
    }

    /**
     * Reinstall a specified server.
     *
     * @param int   $serverId
     *
     * @return void
     */
    public function reinstall(int $serverId)
    {
        return $this->http->post("servers/$serverId/reinstall");
    }

    /**
     * Delete the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function delete(int $serverId)
    {
        return $this->http->delete("servers/$serverId");
    }

    /**
     * Force delete the given server.
     *
     * @param int $serverId
     *
     * @return void
     */
    public function forceDelete(int $serverId)
    {
        return $this->http->delete("servers/$serverId/force");
    }
}
