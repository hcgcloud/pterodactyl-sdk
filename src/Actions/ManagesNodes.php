<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Node;

trait ManagesNodes
{
    /**
     * Get a collection of nodes.
     *
     * @return Node[]
     */
    public function nodes()
    {
        return $this->transformCollection(
            $this->get("api/application/nodes")['data'],
            Node::class
        );
    }
}
