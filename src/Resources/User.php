<?php

namespace HCGCloud\Pterodactyl\Resources;

class User extends Resource
{
    /**
     * The id of the user.
     *
     * @var int
     */
    public $id;

    /**
     * The external id of the user.
     *
     * @var int
     */
    public $externalId;

    /**
     * The uuid of the user.
     *
     * @var int
     */
    public $uuid;

    /**
     * The username of the user.
     *
     * @var string
     */
    public $username;

    /**
     * The email of the user.
     *
     * @var string
     */
    public $email;

    /**
     * The first name of the user.
     *
     * @var string
     */
    public $firstName;

    /**
     * The last name of the user.
     *
     * @var string
     */
    public $lastName;

    /**
     * The language of the user.
     *
     * @var string
     */
    public $language;

    /**
     * If a user is an admin.
     *
     * @var int
     */
    public $rootAdmin;

    /**
     * The date/time the user was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the user was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * The attributes of the user.
     *
     * @var array
     */
    public $attributes = [];

    /**
     * Delete the given user.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->deleteUser($this->id);
    }

    /**
     * Update the given user.
     *
     * @return void
     */
    public function update(array $data)
    {
        return $this->pterodactyl->updateUser($this->id, $data);
    }
}
