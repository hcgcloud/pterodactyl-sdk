<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\User;

trait ManagesUsers
{
    /**
     * Get the collection of users.
     *
     * @param int $page
     *
     * @return array
     */
    public function users(int $page = 1)
    {
        return $this->get('api/application/users?page='.$page);
    }

    /**
     * Get a user instance.
     *
     * @param int   $userId
     * @param array $includes
     *
     * @return User
     */
    public function user(int $userId, array $includes = [])
    {
        return $this->get("api/application/users/$userId".$this->include($includes));
    }

    /**
     * Get a user instance by external id.
     *
     * @param int   $userExternalId
     * @param array $includes
     *
     * @return User
     */
    public function userEx(int $userExternalId, array $includes = [])
    {
        return $this->get("api/application/users/external/$userExternalId".$this->include($includes));
    }

    /**
     * Create a new user.
     *
     * @param array $data
     *
     * @return User
     */
    public function createUser(array $data)
    {
        return $this->post('api/application/users', $data);
    }

    /**
     * Update a specified user.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return User
     */
    public function updateUser(int $userId, array $data)
    {
        return $this->patch("api/application/users/$userId", $data);
    }

    /**
     * Delete the given user.
     *
     * @param int $userId
     *
     * @return void
     */
    public function deleteUser(int $userId)
    {
        return $this->delete("api/application/users/$userId");
    }
}
