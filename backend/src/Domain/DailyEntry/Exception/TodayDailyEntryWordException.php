<?php

namespace App\Domain\DailyEntry\Exception;

use Psr\Log\InvalidArgumentException;

class TodayDailyEntryWordException extends InvalidArgumentException
{
    /**
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        $defaultMessage = 'Daily entry with today date already exists!';

        parent::__construct($message ?: $defaultMessage);
    }
}
