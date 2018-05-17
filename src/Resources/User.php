<?php

namespace Fruitbytes\Pterodactyl\Resources;

class User extends Resource
{
    /**
     * The type of the user.
     *
     * @var string
     */
    public $type;

    /**
     * The id of the user.
     *
     * @var integer
     */
    public $id;

    /**
     * The uuid of the user.
     *
     * @var integer
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
    public $nameFirst;

    /**
     * The last name of the user.
     *
     * @var string
     */
    public $nameLast;

    /**
     * The language of the user.
     *
     * @var string
     */
    public $language;

    /**
     * If a user is an admin.
     *
     * @var integer
     */
    public $rootAdmin;

    /**
     * The use_totp setting for the user.
     *
     * @var integer
     */
    public $useTotp;

    /**
     * The gravatar id of the user.
     *
     * @var integer
     */
    public $gravatar;

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
}
