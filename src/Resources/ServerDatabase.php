<?php

namespace HCGCloud\Pterodactyl\Resources;

class ServerDatabase extends Resource
{
    /**
     * The id of the server's database.
     *
     * @var int
     */
    public $id;

    /**
     * The server id of the server's database.
     *
     * @var int
     */
    public $server;

    /**
     * The host id of the server's database.
     *
     * @var int
     */
    public $host;

    /**
     * The name of the server's database.
     *
     * @var string
     */
    public $database;

    /**
     * The username of the server's database.
     *
     * @var string
     */
    public $username;

    /**
     * The remote hostname of the server's database.
     *
     * @var string
     */
    public $remote;

    /**
     * The date/time the server was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the server was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Reset password of the given server's database.
     *
     * @return void
     */
    public function resetPassword()
    {
        return $this->pterodactyl->resetServerDatabasePassword($this->server, $this->id);
    }

    /**
     * Delete the given database of a server.
     *
     * @return void
     */
    public function delete()
    {
        return $this->pterodactyl->deleteServerDatabase($this->server, $this->id);
    }
}
