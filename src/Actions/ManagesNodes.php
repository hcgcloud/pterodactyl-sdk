<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Node;

trait ManagesNodes
{
    /**
     * Get a collection of nodes.
     *
     * @return array
     */
    public function nodes(int $page = 1)
    {
        $data = $this->get('api/application/nodes?page='.$page);
        $transform = $this->transformCollection(
            $data['data'],
            Node::class
        );

        return [
            'data' => $transform,
            'meta' => $data['meta'],
        ];
    }

    /**
     * Get a node instance.
     *
     * @param int $nodeId
     *
     * @return Node
     */
    public function node($nodeId)
    {
        return new Node($this->get("api/application/nodes/$nodeId"), $this);
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
        return new Node($this->post('api/application/nodes', $data), $this);
    }

    /**
     * Update a specified node.
     *
     * @param int   $nodeId
     * @param array $data
     *
     * @return Node
     */
    public function updateNode($nodeId, array $data)
    {
        return new Node($this->patch("api/application/nodes/$nodeId", $data), $this);
    }

    /**
     * Delete the given node.
     *
     * @param int $nodeId
     *
     * @return void
     */
    public function deleteNode($nodeId)
    {
        return $this->delete("api/application/nodes/$nodeId");
    }
}
