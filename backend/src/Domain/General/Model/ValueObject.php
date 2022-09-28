<?php

namespace App\Domain\General\Model;

interface ValueObject
{
    /**
     * @param ValueObject $valueObject
     *
     * @return bool
     */
    function isEqual(ValueObject $valueObject): bool;
}
