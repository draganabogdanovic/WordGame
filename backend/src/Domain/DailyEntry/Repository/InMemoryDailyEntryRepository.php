<?php

namespace App\Domain\DailyEntry\Repository;

use App\Domain\DailyEntry\Model\DailyEntry;
use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\Word\Model\Word;
use DateTime;

class InMemoryDailyEntryRepository implements DailyEntryRepository
{
    /**
     * @var DailyEntry[] $dailyEntry
     */
    public array $dailyEntry = [];

    /**
     * @var User[] $users
     */
    public array $users = [];

    public function __construct()
    {
       $this->dailyEntry = $this->loadDailyEntry();
    }

    /**
     * @param string $userId
     *
     * @return array|null
     */
    public function findDailyEntryWords(string $userId): ?array
    {
        $i = 0;
        $wordList = [];

        while ($i < count($this->dailyEntry)) {
          $dailyEntry = $this->dailyEntry[$i];
          $userCompare = $dailyEntry->getUser();
            if ($userCompare->isEqual(new UserId($userId))) {
              $wordList[] = $dailyEntry->getWord()->getWord();
            }
            $i++;
        }

        return $wordList;
    }

    /**
     * @param string $userId
     *
     * @return bool
     */
    public function findTodayDailyEntry(string $userId): bool
    {
        $dateTime = new DateTime();
        $dateTime = $dateTime->format('Y-m-d');
        $i = 0;
        while ($i < count($this->dailyEntry)) {
            $date = $this->dailyEntry[$i]->getDate()->format('Y-m-d');

                $userCompare = $this->dailyEntry[$i]->getUser();
                if ($userCompare->isEqual(new UserId($userId)) && $dateTime === $date) {
                    return true;
                }
            $i++;
        }

        return false;
    }

    /**
     * @return DailyEntry[]
     */
    public function loadDailyEntry(): array
    {
        $word = new Word('dad');
        $word1 = new Word('level');
        $word2 = new Word('mom');
        $word3 = new Word('palindrome');
        $word4 = new Word('sons');
        $word5 = new Word('hospital');
        $word6 = new Word('home');
        $word7 = new Word('computer');

        $id = new UserId("1");
        $id1 = new UserId("2");
        $id2 = new UserId("3");
        $id3 = new UserId("4");
        $id4 = new UserId("5");
        $id5 = new UserId("6");
        $id6 = new UserId("7");
        $id7 = new UserId("8");

        $de = new DailyEntry($id, $word, new DateTime('2022-06-14'));
        $de1 = new DailyEntry($id1, $word2, new DateTime('2021-11-11'));
        $de2 = new DailyEntry($id2, $word5, new DateTime('2022-07-05'));
        $de3 = new DailyEntry($id3, $word7, new DateTime('2022-07-12'));
        $de4 = new DailyEntry($id4, $word3, new DateTime('2022-10-10'));
        $de5 = new DailyEntry($id5, $word1, new DateTime('2021-07-05'));
        $de6 = new DailyEntry($id6, $word6, new DateTime('2012-08-05'));
        $de7 = new DailyEntry($id7, $word4, new DateTime('2021-07-05'));

        $this->dailyEntry = [$de, $de1, $de2, $de3, $de4, $de5, $de6, $de7];

        return $this->dailyEntry;
    }
}
