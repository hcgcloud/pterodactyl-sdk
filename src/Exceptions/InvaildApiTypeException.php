<?php

namespace HCGCloud\Pterodactyl\Exceptions;

use Exception;

class InvaildApiTypeException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('The apiType is invaild.');
    }
}
