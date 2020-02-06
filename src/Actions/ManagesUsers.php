<?php

namespace HCGCloud\Pterodactyl\Actions;

use HCGCloud\Pterodactyl\Resources\User;

trait ManagesUsers
{
    /**
     * Get the collection of users.
     *
     * @return array
     */
    public function users(int $page = 1)
    {
        $data = $this->get('api/application/users?page='.$page);
        $transform = $this->transformCollection(
            $data['data'],
            User::class
        );

        return [
            'data' => $transform,
            'meta' => $data['meta'],
        ];
    }

    /**
     * Get a user instance.
     *
     * @param int $userId
     *
     * @return User
     */
    public function user($userId)
    {
        return new User($this->get("api/application/users/$userId"), $this);
    }

    /**
     * Get a user instance by external id.
     *
     * @param int $userExternalId
     *
     * @return User
     */
    public function userEx($userExternalId)
    {
        return new User($this->get("api/application/users/external/$userExternalId"), $this);
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
        return new User($this->post('api/application/users', $data), $this);
    }

    /**
     * Update a specified user.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return User
     */
    public function updateUser($userId, array $data)
    {
        return new User($this->patch("api/application/users/$userId", $data), $this);
    }

    /**
     * Delete the given user.
     *
     * @param int $userId
     *
     * @return void
     */
    public function deleteUser($userId)
    {
        return $this->delete("api/application/users/$userId");
    }
}
