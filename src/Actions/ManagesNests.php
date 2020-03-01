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
        $data = $this->get('api/application/nests?page='.$page);
        $transform = $this->transformCollection(
            $data['data'],
            Nest::class
        );

        return [
            'data' => $transform,
            'meta' => $data['meta'],
        ];
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
        return new Nest($this->get("api/application/nests/$nestId"), $this);
    }
}
