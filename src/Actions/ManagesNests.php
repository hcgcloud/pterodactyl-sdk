<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\Nest;

trait ManagesNests
{
    /**
     * Get a collection of nests.
     *
     * @return Nest[]
     */
    public function nests()
    {
        return $this->transformCollection(
            $this->get("api/application/nests")['data'],
            Nest::class
        );
    }
	
    /**
     * Get a nest instance.
     *
     * @param  integer $nestId
     * @return Nest
     */
    public function nest($nestId)
    {
		return new Nest($this->get("api/application/nests/$nestId"), $this);
    }
}
