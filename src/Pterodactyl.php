<?php

namespace HCGCloud\Pterodactyl;

use GuzzleHttp\Client as Client;

use HCGCloud\Pterodactyl\Exceptions\InvaildApiTypeException;

use HCGCloud\Pterodactyl\Managers\Application\UserManager as ApplicationUserManager;
use HCGCloud\Pterodactyl\Managers\Application\LocationManager as ApplicationLocationManager;
use HCGCloud\Pterodactyl\Managers\Application\NodeManager as ApplicationNodeManager;
use HCGCloud\Pterodactyl\Managers\Application\NestManager as ApplicationNestManager;
use HCGCloud\Pterodactyl\Managers\Client\AccountManager as ClientAccountManager;

class Pterodactyl
{
    /**
     * The Pterodactyl base uri.
     *
     * @var string
     */
    public $baseUri;

    /**
     * The Pterodactyl API key.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The API type of the API key.
     *
     * @var string
     */
    public $apiType;

    /**
     * The Http client.
     *
     * @var Client
     */
    public $http;
    
    /**
     * Account manager.
     *
     * @var ClientAccountManager
     */
    public $account;

    /**
     * Location manager.
     *
     * @var ApplicationLocationManager
     */
    public $locations;
    
    /**
     * User manager.
     *
     * @var ApplicationUserManager
     */
    public $users;

    /**
     * Nest manager.
     *
     * @var ApplicationNestManager
     */
    public $nests;

    /**
     * Node manager.
     *
     * @var ApplicationNodeManager
     */
    public $nodes;

    /**
     * Create a new Pterodactyl instance.
     *
     * @param string             $apiKey
     * @param \GuzzleHttp\Client $guzzle
     *
     * @return void
     */
    public function __construct($baseUri, $apiKey, $apiType = 'application', Client $guzzle = null)
    {
        $this->baseUri = $baseUri;

        $this->apiKey = $apiKey;

        if(!in_array($apiType, ['application', 'client'], true)) {
            throw new InvaildApiTypeException();
        }
        $this->apiType = $apiType;

        $this->http = new Http($this, $guzzle);

        $that = $this;
        switch($this->apiType) {
            case 'application':
                $this->locations = new ApplicationLocationManager($that);
                $this->users = new ApplicationUserManager($that);
                $this->nests = new ApplicationNestManager($that);
                $this->nodes = new ApplicationNodeManager($that);
            break;
            case 'client':
                $this->account = new ClientAccountManager($that);
            break;
        }
    }
}
