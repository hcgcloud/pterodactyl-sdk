<?php

namespace HCGCloud\Pterodactyl\Managers;

use HCGCloud\Pterodactyl\Resources\Collection;
use HCGCloud\Pterodactyl\Resources\Server;
use HCGCloud\Pterodactyl\Resources\Stats;

class ServerManager extends Manager
{
    /**
     * Get a paginated collection of servers.
     *
     * @param int   $page
     * @param array $query
     *
     * @return Collection
     */
    public function paginate(int $page = 1, array $query = [])
    {
        switch ($this->apiType) {
            case 'application':
                return $this->http->get('servers', array_merge([
                    'page' => $page,
                ], $query));
            break;
            case 'client':
                return $this->http->get('', array_merge([
                    'page' => $page,
                ], $query));
            break;
        }
    }

    /**
     * Get a server instance by id.
     *
     * @param mixed $serverId
     * @param array $query
     *
     * @return Server
     */
    public function get($serverId, array $query = [])
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
        return $this->http->post('servers', [], $data);
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
     * @param int $serverId
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
     * @param int $serverId
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
     * @param int $serverId
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

    /**
     * Get information for websocket console of a specified server.
     *
     * @param string $serverId
     *
     * @return array
     */
    public function websocket(string $serverId)
    {
        return $this->http->get("servers/$serverId/websocket");
    }

    /**
     * Get resource utilization of a specified server.
     *
     * @param string $serverId
     *
     * @return Stats
     */
    public function resources(string $serverId)
    {
        return $this->http->get("servers/$serverId/resources");
    }

    /**
     * Send a command to a specified server.
     *
     * @param string $serverId
     * @param string $command
     *
     * @return array
     */
    public function command(string $serverId, string $command)
    {
        return $this->http->post("servers/$serverId/command", [], ['command' => $command]);
    }

    /**
     * Send a power signal to a specified server.
     *
     * @param string $serverId
     * @param string $signal
     *
     * @return array
     */
    public function power(string $serverId, string $signal)
    {
        return $this->http->post("servers/$serverId/power", [], ['signal' => $signal]);
    }
}
