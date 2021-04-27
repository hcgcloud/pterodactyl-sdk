<?php

namespace HCGCloud\Pterodactyl\Resources;

class Server extends Resource
{
    /**
     * Update details of the server.
     *
     * @param array $data
     *
     * @return void
     */
    public function updateDetails(array $data)
    {
        return $this->pterodactyl->servers->updateDetails($this->id, $data);
    }

    /**
     * Update build of the server.
     *
     * @param array $data
     *
     * @return void
     */
    public function updateBuild(array $data)
    {
        return $this->pterodactyl->servers->updateBuild($this->id, $data);
    }

    /**
     * Update startup of the server.
     *
     * @param array $data
     *
     * @return void
     */
    public function updateStartup(array $data)
    {
        return $this->pterodactyl->servers->updateStartup($this->id, $data);
    }

    /**
     * Suspend the server.
     *
     * @return void
     */
    public function suspend()
    {
        return $this->pterodactyl->servers->suspend($this->id);
    }

    /**
     * Unsuspend the server.
     *
     * @return void
     */
    public function unsuspend(int $serverId)
    {
        return $this->pterodactyl->servers->unsuspend($this->id);
    }

    /**
     * Reinstall the server.
     *
     * @return void
     */
    public function reinstall()
    {
        return $this->pterodactyl->servers->reinstall($this->id);
    }

    /**
     * Delete the server.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->servers->delete($this->id);
    }

    /**
     * Force delete the server.
     *
     * @return void
     */
    public function forceDelete()
    {
        return $this->pterodactyl->servers->forceDelete($this->id);
    }

    /**
     * Get information for websocket console of the server.
     *
     * @return array
     */
    public function websocket()
    {
        return $this->pterodactyl->servers->websocket($this->identifier);
    }

    /**
     * Get resource utilization of the server.
     *
     * @return Stats
     */
    public function resources()
    {
        return $this->pterodactyl->servers->resources($this->identifier);
    }

    /**
     * Send a command to the server.
     *
     * @return array
     */
    public function command(string $command)
    {
        return $this->pterodactyl->servers->command($this->identifier, $command);
    }

    /**
     * Send a power signal to the server.
     *
     * @param string $signal
     *
     * @return array
     */
    public function power(string $signal)
    {
        return $this->pterodactyl->servers->power($this->identifier, $signal);
    }
}
