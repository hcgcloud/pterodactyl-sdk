<?php

namespace HCGCloud\Pterodactyl\Resources;

use HCGCloud\Pterodactyl\Resources\Resource;

class Location extends Resource
{
    /**
     * Delete the location.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->locations->delete($this->id);
    }

    /**
     * Update the location.
     * 
     * @param array $data
     *
     * @return void
     */
    public function update(array $data = [])
    {
        $data = array_merge([
            'short' => $this->short,
            'long'  => $this->long,
        ], $data);

        return $this->pterodactyl->locations->update($this->id, $data);
    }
}
