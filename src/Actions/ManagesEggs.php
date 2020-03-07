<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Egg;

trait ManagesEggs
{
    /**
     * Get a collection of eggs in a nest.
     *
     * @param int $nestId
     *
     * @return Egg[]
     */
    public function eggs(int $nestId)
    {
        return $this->get("api/application/nests/$nestId/eggs");
    }

    /**
     * Get a egg instance.
     *
     * @param int   $nestId
     * @param int   $eggId
     * @param array $includes
     *
     * @return Egg
     */
    public function egg(int $nestId, int $eggId, array $includes = [])
    {
        return $this->get("api/application/nests/$nestId/eggs/$eggId".$this->include($includes));
    }
}
