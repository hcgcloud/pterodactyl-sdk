<?php

namespace HCGCloud\Pterodactyl\Managers\Node;

use HCGCloud\Pterodactyl\Managers\Manager;
use HCGCloud\Pterodactyl\Resources\Allocation;
use HCGCloud\Pterodactyl\Resources\Collection;

class NodeAllocationManager extends Manager
{
    /**
     * Get a paginated collection of node allocations.
     *
     * @param int   $nodeId
     * @param int   $page
     * @param array $query
     *
     * @return Collection
     */
    public function paginate(int $nodeId, int $page = 1, array $query = [])
    {
        return $this->http->get("nodes/$nodeId/allocations", array_merge([
            'page' => $page,
        ], $query));
    }

    /**
     * Create a new allocation for a node.
     *
     * @param int   $nodeId
     * @param array $data
     *
     * @return Allocation
     */
    public function create(int $nodeId, array $data)
    {
        return $this->http->post("nodes/$nodeId/allocations", [], $data);
    }

    /**
     * Delete the given allocation of a node.
     *
     * @param int $nodeId
     * @param int $allocationId
     *
     * @return void
     */
    public function delete(int $nodeId, int $allocationId)
    {
        return $this->http->delete("nodes/$nodeId/allocations/$allocationId");
    }
}
