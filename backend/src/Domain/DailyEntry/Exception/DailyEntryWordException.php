<?php

namespace App\Domain\DailyEntry\Exception;

use Psr\Log\InvalidArgumentException;

class DailyEntryWordException extends InvalidArgumentException
{
    /**
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        $defaultMessage = 'Daily entry with that date does not exists!';

        parent::__construct($message ?: $defaultMessage);
    }
}
