<?php

namespace App\Application;

use App\Domain\DailyEntry\Exception\DailyEntryWordException;
use App\Domain\DailyEntry\Exception\TodayDailyEntryWordException;
use App\Domain\DailyEntry\Model\DailyEntry;
use App\Domain\DailyEntry\Repository\DailyEntryRepository;
use App\Domain\User\Repository\UserRepository;
use App\Domain\Word\Exception\WordIsNotInTheDictionaryException;
use App\Domain\Word\Model\Word;
use App\Domain\Word\Service\Dictionary;
use DateTime;

class DailyEntryService
{
    /**
     * @var DailyEntryRepository $dailyEntryRepository
     */
    public DailyEntryRepository $dailyEntryRepository;

    /**
     * @var UserRepository $userRepository
     */
    public UserRepository $userRepository;

    /**
     * @var Dictionary $dictionary
     */
    public Dictionary $dictionary;

    /**
     * @param DailyEntryRepository $dailyEntryRepository
     * @param UserRepository $userRepository
     * @param Dictionary $dictionary
     */
    public function __construct(DailyEntryRepository $dailyEntryRepository, UserRepository $userRepository, Dictionary $dictionary)
    {
        $this->dailyEntryRepository = $dailyEntryRepository;
        $this->userRepository = $userRepository;
        $this->dictionary = $dictionary;
    }

    /**
     * @param string $userId
     *
     * @return array|null
     *
     * @throws DailyEntryWordException
     * @throws WordIsNotInTheDictionaryException
     */
    public function getWordsForUser(string $userId): ?array
    {
        $dailyEntry = $this->dailyEntryRepository->findDailyEntryWords($userId);
        if (!$dailyEntry) {
            throw new DailyEntryWordException();
        }

        $dailyEntryList = array();
        for($i = 0; $i < count($dailyEntry); $i++) {
            $word = new Word($dailyEntry[$i]);

            if (!$this->dictionary->validateWord($word)) {
              throw new WordIsNotInTheDictionaryException();
            }
            $score = $word->getScore()->getPoints();
            $dailyEntryList[] =  ['word'=> $dailyEntry[$i], 'score'=> $score];
        }

        return $dailyEntryList;
    }

    /**
     * @param string $word
     * @param string $userId
     *
     * @return int
     *
     * @throws TodayDailyEntryWordException
     * @throws WordIsNotInTheDictionaryException
     */
    public function addWordForUser(string $word, string $userId): int
    {
        $todayDailyEntry = $this->dailyEntryRepository->findTodayDailyEntry($userId);
        if($todayDailyEntry) {
          throw new TodayDailyEntryWordException();
        }

        $word = new Word($word);

        if (!$this->dictionary->validateWord($word)) {
          throw new WordIsNotInTheDictionaryException();
        }
        $score = $word->getScore()->getPoints();

        $date = new DateTime();
        $date = $date->format('Y-m-d');
        $date = DateTime::createFromFormat('Y-m-d', $date);

        return $score;
    }
}
