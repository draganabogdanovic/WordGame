<?php

namespace App\Domain\Word\Adapter;

use App\Domain\Word\Model\Word;
use App\Domain\Word\Service\Dictionary;

class EnglishDictionaryFile implements Dictionary
{
    /**
     * @var string[] $englishDictionaryFile
     */
    private array $englishDictionaryFile = [];

    /**
     * @param Word $word
     *
     * @return bool
     */
    public function validateWord(Word $word): bool
    {
        return array_key_exists($word->getWord(), $this->loadEnglishDictionaryFile());
    }

    /**
     * @return array
     */
    private function loadEnglishDictionaryFile(): array
    {
        $englishDictionary = file_get_contents(__DIR__ . "/../../../../resources/EnglishDictionary.txt");
        $this->englishDictionaryFile = json_decode($englishDictionary, 1);
        return $this->englishDictionaryFile;
    }
}
