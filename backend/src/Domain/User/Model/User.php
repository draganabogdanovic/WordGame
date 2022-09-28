<?php

namespace App\Domain\User\Model;

use App\Domain\Email\Model\Email;
use App\Domain\General\Model\AbstractId;
use App\Domain\General\Model\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, Entity
{
    /**
     * @var UserId $id
     */
    private UserId $id;

    /**
     * @var Email $email
     */
    private Email $email;

    /**
     * @param UserId $id
     * @param Email $email
     */
    public function __construct(UserId $id, Email $email)
    {
        $this->id = $id;
        $this->setEmail($email);
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail():Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }


    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
       return $this->id->id();
    }

    function identity(): AbstractId
    {
      return $this->id;
    }
}
