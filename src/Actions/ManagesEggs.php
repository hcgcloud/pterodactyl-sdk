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
    public function eggs($nestId)
    {
        return $this->transformCollection(
            $this->get("api/application/nests/$nestId/eggs")['data'],
            Egg::class
        );
    }

    /**
     * Get a egg instance.
     *
     * @param int $nestId
     * @param int $eggId
     *
     * @return Egg
     */
    public function egg($nestId, $eggId)
    {
        return new Egg($this->get("api/application/nests/$nestId/eggs/$eggId"), $this);
    }
}
