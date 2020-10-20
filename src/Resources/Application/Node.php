<?php

namespace HCGCloud\Pterodactyl\Resources\Application;

use HCGCloud\Pterodactyl\Resources\Resource;

class Node extends Resource
{
    /**
     * Delete the node.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->nodes->delete($this->id);
    }

    /**
     * Update the node.
     * 
     * @param array $data
     *
     * @return void
     */
    public function update(array $data = [])
    {
        return $this->pterodactyl->nodes->update($this->id, $data);
    }

    /**
     * Get a paginated collection of node allocations.
     *
     * @param int $page
     * @param array $query
     *
     * @return Collection
     */
    public function allocations(int $page = 1, array $query = [])
    {
        return $this->pterodactyl->nodes->allocations($this->id, $page, $query);
    }

    /**
     * Create a new allocation for a node.
     *
     * @param array $data
     *
     * @return User
     */
    public function createAllocation(array $data)
    {
        return $this->pterodactyl->nodes->createAllocation($this->id, $data);
    }

    /**
     * Delete the given allocation of a node.
     *
     * @param int $allocationId
     *
     * @return void
     */
    public function deleteAllocation(int $allocationId)
    {
        return $this->pterodactyl->nodes->deleteAllocation($this->id, $allocationId);
    }
}
