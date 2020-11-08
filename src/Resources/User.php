<?php

namespace HCGCloud\Pterodactyl\Resources;

class User extends Resource
{
    /**
     * Save the user.
     *
     * @return void
     */
    public function save()
    {
        return $this->update(array_merge(
            [
                'email'      => $this->email,
                'username'   => $this->username,
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name, ],
            $this->getChangedData()
        ));
    }

    /**
     * Update the user.
     *
     * @param array $data
     *
     * @return void
     */
    public function update(array $data)
    {
        $this->pterodactyl->users->update($this->id, $data);
    }

    /**
     * Delete the user.
     *
     * @return void
     */
    public function delete()
    {
        $this->pterodactyl->users->delete($this->id);
    }
}
