<?php

namespace App\Domain\Word\Exception;

use InvalidArgumentException;

class WordIsNotInTheDictionaryException extends InvalidArgumentException
{
    /**
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        $defaultMessage = 'A word is not from english dictionary.';

        parent::__construct($message ?: $defaultMessage);
    }

}
