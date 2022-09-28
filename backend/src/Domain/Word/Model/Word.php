<?php

namespace App\Domain\Word\Model;

use App\Domain\General\Model\ValueObject;
use App\Domain\Word\Exception\WordFormatException;
use InvalidArgumentException;

class Word implements ValueObject
{
    /**
     * @var string $word
     */
    private string $word;

    /**
     * @param string $wordString
     */
    public function __construct(string $wordString)
    {
        $this->setWord($wordString);
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return Points
     */
    public function getScore(): Points
    {
        $i = 0;
        $j = strlen($this->word) - 1;
        $score = 0;

        $uniqueCount = $this->uniqueLettersCount();
        $score += $uniqueCount;

        if ($this->isPalindrome($i, $j)) {
            $score += 3;
        } elseif ($this->isAlmostPalindrome()) {
            $score += 2;
        }

        return new Points($score);
    }

    /**
     * @return int
     */
    public function uniqueLettersCount(): int
    {
        return count(array_unique(str_split($this->word)));
    }

    /**
     * @return bool
     */
    public function isPalindrome(): bool
    {
        return $this->isSubstringPalindrome(0, strlen($this->getWord()) - 1);
    }

    /**
     * @return bool
     */
    public function isAlmostPalindrome(): bool
    {
        $originalWord = str_split($this->word);
        $i = 0;
        $j = count($originalWord) - 1;

        while ($i < $j) {
            if ($originalWord[$i] != $originalWord[$j]) {
                return  $this->isSubstringPalindrome($i, $j - 1) || $this->isSubstringPalindrome($i + 1, $j);
            }
            $i++;
            $j--;
        }

        return false;
    }

    /**
     * @param ValueObject $valueObject
     *
     * @return bool
     */
    public function isEqual(ValueObject $valueObject): bool
    {
        if (!($valueObject instanceof Word)) {
            return false;
        }

        return $this->word === $valueObject->getWord();
    }

    /**
     * @param int $i start index of word
     * @param int $j end index of word
     *
     * @return bool
     */
    private function isSubstringPalindrome(int $i, int $j): bool
    {
        $originalWord = str_split($this->word);

        while ($i < $j) {
            if ($originalWord[$i] != $originalWord[$j]) {
                return false;
            }
            $i++;
            $j--;
        }

        return true;
    }

    /**
     * @throws InvalidArgumentException
     *
     * @throws WordFormatException
     */
    private function setWord(string $word): void
    {
        $word = strtolower($word);
        $word = trim($word);

        if (empty($word)) {
            throw new WordFormatException("Word must have at least one character.");
        } elseif (str_contains($word, " ")) {
            throw new WordFormatException("A word can not contain a space.");
        } elseif (preg_match("~[0-9]+~", $word)) {
            throw new WordFormatException("A word can not contain numbers.");
        } elseif (preg_match("/[\':;^£$%&*()}{@#~?!><>,|=_+¬-]/", $word)) {
            throw new WordFormatException("A word can not contain special characters.");
        }
        $this->word = $word;
    }
}
