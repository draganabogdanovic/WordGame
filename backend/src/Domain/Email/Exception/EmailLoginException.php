<?php

namespace App\Domain\Email\Exception;

use InvalidArgumentException;

class EmailLoginException extends InvalidArgumentException
{
    /**
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        $defaultMessage = "User with that email does not exists!";

        parent::__construct($message ?: $defaultMessage);
    }
}
