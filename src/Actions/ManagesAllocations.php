<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Allocation;

trait ManagesAllocations
{
    /**
     * Get the collection of allocations for a given node.
     *
     * @param  integer $nodeId
     * @return array
     */
    public function allocations($nodeId, int $page = 1)
    {
        $data = $this->get("api/application/nodes/$nodeId" . "/allocations?page=" . $page);
        $transform = $this->transformCollection(
            $data['data'],
            Allocation::class
        );
        return [
            'data' => $transform,
            'meta' => $data['meta']
        ];
    }

    /**
     * Create new allocation(s).
     *
     * @param  integer $nodeId
     * @param  array $data
     * @return void
     */
    public function createAllocation($nodeId, array $data)
    {
        return $this->post("api/application/nodes/$nodeId/allocations", $data);
    }

    /**
     * Delete the given allocation.
     *
     * @param  integer $nodeId
     * @param  integer $allocationId
     * @param  array $data
     * @return void
     */
    public function deleteAllocation($nodeId, $allocationId)
    {
        return $this->delete("api/application/nodes/$nodeId/allocations/$allocationId");
    }
}
