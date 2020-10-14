<?php

namespace HCGCloud\Pterodactyl\Managers\Application;

use HCGCloud\Pterodactyl\Pterodactyl;

use HCGCloud\Pterodactyl\Managers\Manager;

use HCGCloud\Pterodactyl\Resources\Collection;

use HCGCloud\Pterodactyl\Resources\Application\Nest;
use HCGCloud\Pterodactyl\Resources\Application\Egg;

class NestManager extends Manager
{
    /**
     * Get a paginated collection of nests.
     *
     * @param int $page
     * @param array $query
     *
     * @return Collection
     */
    public function paginate(int $page = 1, array $query = [])
    {
        return $this->http->get('nests', array_merge([
            'page' => $page
        ], $query));
    }

    /**
     * Get a nest instance by id.
     *
     * @param int   $nestId
     * @param array $query
     *
     * @return Nest
     */
    public function get(int $nestId, array $query = [])
    {
        return $this->http->get("nests/$nestId", $query);
    }

    /**
     * Get a paginated collection of eggs.
     *
     * @param int $nestId
     * @param int $page
     * @param array $query
     *
     * @return Collection
     */
    public function eggs(int $nestId, int $page = 1, array $query = [])
    {
        return $this->http->get("nests/$nestId/eggs", array_merge([
            'page' => $page
        ], $query));
    }

    /**
     * Get a egg instance by id.
     *
     * @param int   $nestId
     * @param int   $eggId
     * @param array $query
     *
     * @return Egg
     */
    public function egg(int $nestId, int $eggId, array $query = [])
    {
        return $this->http->get("nests/$nestId/eggs/$eggId", $query);
    }
}
