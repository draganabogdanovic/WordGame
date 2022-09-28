<?php

namespace App\Domain\Word\Exception;

use InvalidArgumentException;

class NegativeScoreException extends InvalidArgumentException
{
    /**
     * @param string $message
     */
    public function __construct(string $message) {

        parent::__construct($message);
    }

    public static function valueOf(): static
    {
        return new static("Score can not be negative or zero value.");
    }
}
