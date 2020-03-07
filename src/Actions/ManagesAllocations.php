<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Allocation;

trait ManagesAllocations
{
    /**
     * Get the collection of allocations for a given node.
     *
     * @param int $nodeId
     * @param int $page
     *
     * @return array
     */
    public function allocations(int $nodeId, int $page = 1)
    {
        return $this->get("api/application/nodes/$nodeId".'/allocations?page='.$page);
    }

    /**
     * Create new allocation(s).
     *
     * @param int   $nodeId
     * @param array $data
     *
     * @return void
     */
    public function createAllocation(int $nodeId, array $data)
    {
        return $this->post("api/application/nodes/$nodeId/allocations", $data);
    }

    /**
     * Delete the given allocation.
     *
     * @param int   $nodeId
     * @param int   $allocationId
     * @param array $data
     *
     * @return void
     */
    public function deleteAllocation(int $nodeId, int $allocationId)
    {
        return $this->delete("api/application/nodes/$nodeId/allocations/$allocationId");
    }
}
