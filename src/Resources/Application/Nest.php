<?php

namespace HCGCloud\Pterodactyl\Resources\Application;

use HCGCloud\Pterodactyl\Resources\Collection;

use HCGCloud\Pterodactyl\Resources\Resource;

class Nest extends Resource
{

    /**
     * Get a paginated collection of eggs.
     *
     * @param int $page
     * @param array $query
     *
     * @return Collection
     */
    public function eggs(int $page = 1, array $query = [])
    {
        return $this->pterodactyl->nests->eggs($this->id, $page, $query);
    }

    /**
     * Get a egg instance by id.
     *
     * @param int   $eggId
     * @param array $query
     *
     * @return Egg
     */
    public function egg(int $eggId, array $query = [])
    {
        return $this->pterodactyl->nests->egg($this->id, $eggId, $query);
    }

}
