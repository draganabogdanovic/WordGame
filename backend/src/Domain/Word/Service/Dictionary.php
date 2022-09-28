<?php

namespace App\Domain\Word\Service;

use App\Domain\Word\Model\Word;

interface Dictionary
{

    /**
     * @param Word $word
     *
     * @return bool
     */
    function validateWord(Word $word): bool;
}
