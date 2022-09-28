<?php

namespace App\Domain\General\Model;

interface Entity
{
    /**
     * @return AbstractId
     */
    function identity(): AbstractId;
}
