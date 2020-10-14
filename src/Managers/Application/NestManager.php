<?php

namespace HCGCloud\Pterodactyl\Managers\Application;

use HCGCloud\Pterodactyl\Pterodactyl;

use HCGCloud\Pterodactyl\Managers\Manager;

use HCGCloud\Pterodactyl\Managers\Application\Nest\EggManager;

use HCGCloud\Pterodactyl\Resources\Collection;

use HCGCloud\Pterodactyl\Resources\Application\Nest;

class NestManager extends Manager
{

    /**
     * Eggs manager.
     *
     * @var EggManager
     */
    public $eggs;

    public function __construct(Pterodactyl $pterodactyl)
    {
        parent::__construct($pterodactyl);
        $this->eggs = new EggManager($pterodactyl);
    }

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
}
