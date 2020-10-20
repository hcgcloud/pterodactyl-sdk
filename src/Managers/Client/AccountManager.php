<?php

namespace HCGCloud\Pterodactyl\Managers\Client;

use HCGCloud\Pterodactyl\Managers\Manager;

use HCGCloud\Pterodactyl\Resources\User;
use HCGCloud\Pterodactyl\Resources\Client\SystemPermissions;

class AccountManager extends Manager
{
    /**
     * Get information of the account.
     *
     * @return User
     */
    public function details()
    {
        return $this->http->get('account');
    }

    /**
     * Get permissions of the account.
     * 
     * @return SystemPermissions
     */
    public function permissions()
    {
        return $this->http->get('permissions');
    }
}
