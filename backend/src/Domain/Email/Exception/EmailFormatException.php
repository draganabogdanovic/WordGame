<?php

namespace App\Domain\Email\Exception;

use InvalidArgumentException;

class EmailFormatException extends InvalidArgumentException
{
    /**
     * @param string $message
     */
    public function __construct(string $message) {

        parent::__construct($message);
    }

    public static function valueOf(): static
    {
        return new static("A email is not in valid format.");
    }
}
