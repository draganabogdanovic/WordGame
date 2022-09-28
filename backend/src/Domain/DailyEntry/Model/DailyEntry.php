<?php

namespace App\Domain\DailyEntry\Model;

use App\Domain\User\Model\UserId;
use App\Domain\Word\Model\Word;
use DateTime;

class DailyEntry
{
    /**
     * @var UserId $user
     */
    private UserId $user;

    /**
     * @var Word $word
     */
    private Word $word;

    /**
     * @var DateTime $date
     */
    private DateTime $date;

    /**
     * @param UserId $user
     * @param Word $word
     * @param DateTime $dateTime
     */
    public function __construct(UserId $user, Word $word, DateTime $dateTime)
    {
        $this->user = $user;
        $this->word = $word;
        $this->date = $dateTime;
    }

    /**
     * @return UserId
     */
    public function getUser(): UserId
    {
        return $this->user;
    }

    /**
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }
}
