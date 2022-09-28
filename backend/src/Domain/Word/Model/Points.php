<?php

namespace App\Domain\Word\Model;

use App\Domain\General\Model\ValueObject;
use App\Domain\Word\Exception\NegativeScoreException;

class Points implements ValueObject
{
    /**
     * @var int $points
     */
    private int $points;

    /**
     * @param int $points
     */
    public function __construct(int $points)
    {
        $this->setPoints($points);
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param ValueObject $valueObject
     *
     * @return bool
     */
    public function isEqual(ValueObject $valueObject): bool
    {
        if (!($valueObject instanceof Points)) {
            return false;
        }

        return $this->getPoints() === $valueObject->getPoints();
    }

    /**
     * @param int $points
     *
     * @throws NegativeScoreException
     */
    private function setPoints(int $points): void
    {
        if ($points <= 0) {
            throw new NegativeScoreException("Score can not be negative or zero value.");
        } elseif (!is_numeric($points)) {
            throw new NegativeScoreException("Score can not not numeric value.");
        }
        $this->points = $points;
    }
}
