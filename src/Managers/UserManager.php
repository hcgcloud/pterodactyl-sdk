<?php

namespace HCGCloud\Pterodactyl\Managers;

use HCGCloud\Pterodactyl\Resources\Collection;
use HCGCloud\Pterodactyl\Resources\User;

class UserManager extends Manager
{
    /**
     * Get a paginated collection of users.
     *
     * @param int   $page
     * @param array $query
     *
     * @return Collection
     */
    public function paginate(int $page = 1, array $query = [])
    {
        return $this->http->get('users', array_merge([
            'page' => $page,
        ], $query));
    }

    /**
     * Get a user instance by user id.
     *
     * @param int   $userId
     * @param array $query
     *
     * @return User
     */
    public function get(int $userId, array $query = [])
    {
        return $this->http->get("users/$userId", $query);
    }

    /**
     * Get a user instance by user external id.
     *
     * @param string $externalId
     * @param array  $includes
     *
     * @return User
     */
    public function getByExternalid(string $externalId, array $query = [])
    {
        return $this->http->get("users/external/$externalId", $query);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        return $this->http->post('users', [], $data);
    }

    /**
     * Update a specified user.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return User
     */
    public function update(int $userId, array $data)
    {
        return $this->http->patch("users/$userId", [], $data);
    }

    /**
     * Delete the given user.
     *
     * @param int $userId
     *
     * @return void
     */
    public function delete(int $userId)
    {
        return $this->http->delete("users/$userId");
    }
}
