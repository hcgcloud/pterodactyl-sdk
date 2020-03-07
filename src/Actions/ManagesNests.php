<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Nest;

trait ManagesNests
{
    /**
     * Get a collection of nests.
     *
     * @param int $page
     *
     * @return array
     */
    public function nests(int $page = 1)
    {
        return $this->get('api/application/nests?page='.$page);
    }

    /**
     * Get a nest instance.
     *
     * @param int $nestId
     *
     * @return Nest
     */
    public function nest(int $nestId)
    {
        return $this->get("api/application/nests/$nestId");
    }
}
