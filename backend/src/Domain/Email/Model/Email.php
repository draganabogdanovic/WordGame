<?php

namespace App\Domain\Email\Model;

use App\Domain\Email\Exception\EmailFormatException;
use App\Domain\General\Model\ValueObject;
use InvalidArgumentException;

class Email implements ValueObject
{
    /**
     * @var string $email
     */
    private string $email;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param ValueObject $valueObject
     *
     * @return bool
     */
    public function isEqual(ValueObject $valueObject): bool
    {
        if (!($valueObject instanceof Email)) {
            return false;
        }

        return $this->email === $valueObject->getEmail();
    }

    /**
     * @throws InvalidArgumentException
     *
     * @throws EmailFormatException
     */
    private function setEmail(string $email): void
    {
        $email = trim($email);

        if (empty($email)) {
            throw new EmailFormatException("Please enter your email.");
        } elseif (str_contains($email, " ")) {
            throw new EmailFormatException("A email can not contain a space.");;
        } elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            throw new EmailFormatException("A email does not contain valid format.");
        }
        $this->email = $email;
    }
}
