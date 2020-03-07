<?php

namespace HCGCloud\Pterodactyl\Resources;

class Node extends Resource
{
    /**
     * The id of the node.
     *
     * @var int
     */
    public $id;

    /**
     * The node is public or not.
     *
     * @var int
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
     * @var int
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
     * @var int
     */
    public $memory;

    /**
     * The memory overallocate of the node.
     *
     * @var int
     */
    public $memoryOverallocate;

    /**
     * The disk of the node.
     *
     * @var int
     */
    public $disk;

    /**
     * The disk overallocate of the node.
     *
     * @var int
     */
    public $diskOverallocate;

    /**
     * The upload size of the node.
     *
     * @var int
     */
    public $uploadSize;

    /**
     * The daemon listen port of the node.
     *
     * @var int
     */
    public $daemonListen;

    /**
     * The daemon sftp port of the node.
     *
     * @var int
     */
    public $daemonSftp;

    /**
     * The daemon base of the node.
     *
     * @var string
     */
    public $daemonBase;

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
     * @param array $data
     *
     * @return void
     */
    public function update(array $data)
    {
        return $this->pterodactyl->updateNode($this->id, $data);
    }

    /**
     * Get a collection of allocations of the given node.
     *
     * @param int $page
     *
     * @return array
     */
    public function allocations(int $page = 1)
    {
        return $this->pterodactyl->allocations($this->id, $page);
    }

    /**
     * Create new allocation(s) of the given node.
     *
     * @param array $data
     *
     * @return void
     */
    public function createAllocation(array $data)
    {
        return $this->pterodactyl->createAllocation($this->id, $data);
    }

    /**
     * Delete a allocation of the given node.
     *
     * @param int $allocationId
     *
     * @return void
     */
    public function deleteAllocation(int $allocationId)
    {
        return $this->pterodactyl->deleteAllocation($this->id, $allocationId);
    }
}
