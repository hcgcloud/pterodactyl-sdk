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
}
