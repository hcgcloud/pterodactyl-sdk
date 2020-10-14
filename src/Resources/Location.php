<?php

namespace HCGCloud\Pterodactyl\Resources;

class Location extends Resource
{
    /**
     * Delete the given location.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->locations->delete($this->id);
    }

    /**
     * Update the given location.
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
