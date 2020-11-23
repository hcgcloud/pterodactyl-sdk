<?php

namespace HCGCloud\Pterodactyl\Managers;

use HCGCloud\Pterodactyl\Resources\Collection;
use HCGCloud\Pterodactyl\Resources\Nest;

class NestManager extends Manager
{
    /**
     * Get a paginated collection of nests.
     *
     * @param int   $page
     * @param array $query
     *
     * @return Collection
     */
    public function paginate(int $page = 1, array $query = [])
    {
        return $this->http->get('nests', array_merge([
            'page' => $page,
        ], $query));
    }

    /**
     * Get a nest instance by id.
     *
     * @param int   $nestId
     * @param array $includes
     *
     * @return Nest
     */
    public function get(int $nestId, array $includes = [])
    {
        return $this->http->get("nests/$nestId", $includes);
    }
}
