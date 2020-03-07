<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Node;

trait ManagesNodes
{
    /**
     * Get a collection of nodes.
     *
     * @param int $page
     *
     * @return array
     */
    public function nodes(int $page = 1)
    {
        return $this->get('api/application/nodes?page='.$page);
    }

    /**
     * Get a node instance.
     *
     * @param int   $nodeId
     * @param array $includes
     *
     * @return Node
     */
    public function node(int $nodeId, array $includes = [])
    {
        return $this->get("api/application/nodes/$nodeId".$this->include($includes));
    }

    /**
     * Create a new node.
     *
     * @param array $data
     *
     * @return Node
     */
    public function createNode(array $data)
    {
        return $this->post('api/application/nodes', $data);
    }

    /**
     * Update a specified node.
     *
     * @param int   $nodeId
     * @param array $data
     *
     * @return Node
     */
    public function updateNode(int $nodeId, array $data)
    {
        return $this->patch("api/application/nodes/$nodeId", $data);
    }

    /**
     * Delete the given node.
     *
     * @param int $nodeId
     *
     * @return void
     */
    public function deleteNode(int $nodeId)
    {
        return $this->delete("api/application/nodes/$nodeId");
    }
}
