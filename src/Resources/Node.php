<?php

namespace HCGCloud\Pterodactyl\Resources;

class Node extends Resource
{
    /**
     * The id of the node.
     *
     * @var integer
     */
    public $id;

    /**
     * The node is public or not.
     *
     * @var integer
     */
    public $public;

    /**
     * The name of the node.
     *
     * @var string
     */
    public $name;

    /**
     * The description of the node.
     *
     * @var string
     */
    public $description;

    /**
     * The location id of the node.
     *
     * @var integer
     */
    public $locationId;

    /**
     * The fqdn of the node.
     *
     * @var string
     */
    public $fqdn;

    /**
     * The scheme of the node.
     *
     * @var string
     */
    public $scheme;

    /**
     * The behind proxy set of the node.
     *
     * @var boolen
     */
    public $behindProxy;

    /**
     * The maintenance mode status of the node.
     *
     * @var string
     */
    public $maintenanceMode;

    /**
     * The memory of the node.
     *
     * @var integer
     */
    public $memory;

    /**
     * The memory overallocate of the node.
     *
     * @var integer
     */
    public $memoryOverallocate;
	
    /**
     * The disk of the node.
     *
     * @var integer
     */
    public $disk;

    /**
     * The disk overallocate of the node.
     *
     * @var integer
     */
    public $diskOverallocate;
	
    /**
     * The upload size of the node.
     *
     * @var integer
     */
    public $uploadSize;
	
    /**
     * The daemon listen port of the node.
     *
     * @var integer
     */
    public $daemonListen;
	
    /**
     * The daemon sftp port of the node.
     *
     * @var integer
     */
    public $daemonSftp;
	
    /**
     * The daemon base of the node.
     *
     * @var string
     */
    public $daemonBase;
	
    /**
     * The attributes of the node.
     *
     * @var array
     */
    public $attributes = [];
	
    /**
     * The date/time the node was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the node was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Delete the given node.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->deleteNode($this->id);
    }

    /**
     * Update the given node.
     *
     * @return void
     */
    public function update(array $data)
    {
        return $this->pterodactyl->updateNode($this->id, $data);
    }
}
