<?php

namespace App\Domain\Word\Exception;

use InvalidArgumentException;

class WordFormatException extends InvalidArgumentException
{
    /**
     * @param string $message
     */
    public function __construct(string $message) {

        parent::__construct($message);
    }

    public static function valueOf(): static
    {
        return new static("A word can not contain whitespace, numbers or special characters.");
    }
}
