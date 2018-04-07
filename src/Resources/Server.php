<?php

namespace Fruitbytes\Pterodactyl\Resources;

class Server extends Resource
{
    /**
     * The id of the server.
     *
     * @var integer
     */
    public $id;

    /**
     * The name of the server.
     *
     * @var string
     */
    public $name;

    /**
     * The id of the provider credential instance.
     *
     * @var integer
     */
    public $credentialId;

    /**
     * The size of the server.
     *
     * @var string
     */
    public $size;

    /**
     * The region of the server.
     *
     * @var string
     */
    public $region;

    /**
     * The IP address of the server.
     *
     * @var string
     */
    public $ipAddress;

    /**
     * The Private IP address of the server.
     *
     * @var string
     */
    public $privateIpAddress;

    /**
     * The PHP version used in the server.
     *
     * @var string
     */
    public $phpVersion;

    /**
     * The status of the Blackfire service.
     *
     * @var string
     */
    public $blackfireStatus;

    /**
     * The status of the Papertrail service.
     *
     * @var string
     */
    public $papertrailStatus;

    /**
     * Determine if the server installation is done.
     *
     * @var bool
     */
    public $isReady;

    /**
     * Determine if Pterodactyl access to the server was revoked.
     *
     * @var bool
     */
    public $revoked;

    /**
     * The date/time the server was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The IDs of other servers on the same servers network.
     *
     * @var array
     */
    public $network = [];

    /**
     * Update the given server.
     *
     * @param  array $data
     * @return Server
     */
    public function update(array $data)
    {
        return $this->forge->updateServer($this->id, $data);
    }

    /**
     * Delete the given server.
     *
     * @return void
     */
    public function delete()
    {
        return $this->forge->deleteServer($this->id);
    }

    /**
     * Reboot the server.
     *
     * @return void
     */
    public function reboot()
    {
        return $this->forge->rebootServer($this->id);
    }
}
