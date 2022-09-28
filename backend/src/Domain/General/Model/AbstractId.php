<?php

namespace App\Domain\General\Model;

abstract class AbstractId implements ValueObject
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }


  /**
   *  @param AbstractId|ValueObject $other
   *
   * @return bool
   */
    public function isEqual(ValueObject $other): bool
    {
        if ($other === null || get_class($this) !== get_class($other)) {
          return false;
        }

        return $this->id() === $other->id();
    }
}
