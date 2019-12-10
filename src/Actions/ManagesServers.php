<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Server;
use HCGCloud\Pterodactyl\Resources\Allocation;

trait ManagesServers
{

    /**
     * Get the collection of servers.
     *
     * @return array
     */
    public function servers(int $page = 1)
    {
        $data = $this->get("api/application/servers?page=" . $page);
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
     * Get a server instance.
     *
     * @param  integer $serverId
     * @return Server
     */
    public function server($serverId)
    {
        $request = $this->get("api/application/servers/$serverId" . "?include=allocations");
		
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
     * @param  integer $externalId
     * @return Server
     */
    public function serverEx($externalId)
    {
        $request = $this->get("api/application/servers/external/$externalId" . "?include=allocations");
		
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
     * @param  array $data
     * @return Server
     */
    public function createServer(array $data)
    {
        return new Server($this->post('api/application/servers', $data), $this);
    }

    /**
     * Delete the given server.
     *
     * @param  integer $serverId
     * @return void
     */
    public function deleteServer($serverId)
    {
        return $this->delete("api/application/servers/$serverId");
    }
	
    /**
     * Force delete the given server.
     *
     * @param  integer $serverId
     * @return void
     */
    public function forceDeleteServer($serverId)
    {
        return $this->delete("api/application/servers/$serverId/force");
    }

    /**
     * Update details of the given server.
     *
     * @param  integer $serverId
	 * @param  array  $data
     * @return void
     */
    public function updateServerDetails($serverId, array $data)
    {
        return $this->patch("api/application/servers/$serverId/details", $data);
    }

    /**
     * Update build configuration of the given server.
     *
     * @param  integer $serverId
	 * @param  array  $data
     * @return void
     */
    public function updateServerBuild($serverId, array $data)
    {
        return $this->patch("api/application/servers/$serverId/build", $data);
    }

    /**
     * Update startup parameters of the given server.
     *
     * @param  integer $serverId
	 * @param  array  $data
     * @return void
     */
    public function updateServerStartup($serverId, array $data)
    {
        return $this->patch("api/application/servers/$serverId/startup", $data);
    }

    /**
     * Suspend the given server.
     *
     * @param  integer $serverId
     * @return void
     */
    public function suspendServer($serverId)
    {
        return $this->post("api/application/servers/$serverId/suspend");
    }

    /**
     * Unsuspend the given server.
     *
     * @param  integer $serverId
     * @return void
     */
    public function unsuspendServer($serverId)
    {
        return $this->post("api/application/servers/$serverId/unsuspend");
    }
	
    /**
     * Reinstall the given server.
     *
     * @param  integer $serverId
     * @return void
     */
    public function reinstallServer($serverId)
    {
        return $this->post("api/application/servers/$serverId/reinstall");
    }
	
    /**
     * Rebuild the given server.
     *
     * @param  integer $serverId
     * @return void
     */
    public function rebuildServer($serverId)
    {
        return $this->post("api/application/servers/$serverId/rebuild");
    }
}
