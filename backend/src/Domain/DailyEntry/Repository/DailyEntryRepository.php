<?php

namespace App\Domain\DailyEntry\Repository;

interface DailyEntryRepository
{
    /**
     * @param string $userId
     *
     * @return array|null
     */
    function findDailyEntryWords(string $userId): ?array;

    /**
     * @param string $userId
     *
     * @return bool
     */
    function findTodayDailyEntry(string $userId): bool;
}
