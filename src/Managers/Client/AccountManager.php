<?php

namespace HCGCloud\Pterodactyl\Managers\Client;

use HCGCloud\Pterodactyl\Managers\Manager;

use HCGCloud\Pterodactyl\Resources\User;

class AccountManager extends Manager
{
    /**
     * Get information of the account
     *
     * @return User
     */
    public function details()
    {
        return $this->http->get('api/client/account');
    }
}
