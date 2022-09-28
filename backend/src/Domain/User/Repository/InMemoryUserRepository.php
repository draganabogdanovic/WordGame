<?php

namespace App\Domain\User\Repository;

use App\Domain\Email\Model\Email;
use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @var User[] $users
     */
    private array $users = [];

    public function __construct()
    {
        $this->users = $this->loadUsers();
    }

    /**
     * @param Email $email
     *
     * @return User|null
     */
    public  function findUserByEmail(Email $email): ?User
    {
        for ($i = 0; $i < count($this->users); $i++) {
            if ($email->isEqual($this->users[$i]->getEmail())) {
                return $this->users[$i];
            }
        }

        return null;
    }

    /**
     * @param string $id
     *
     * @return User|null
     */
    public function findUserById(string $id) : ?User
    {
        for ($i = 0; $i < count($this->users); $i++) {
            if ($id === $this->users[$i]->getId()->id()) {
                return $this->users[$i];
            }
        }

        return null;
    }

    /**
     * @return User[]
     */
    public function loadUsers(): array
    {
        $id = new UserId("1");
        $id1 = new UserId("2");
        $id2 = new UserId("3");
        $id3 = new UserId("4");
        $id4 = new UserId("5");
        $id5 = new UserId("6");
        $id6 = new UserId("7");
        $id7 = new UserId("8");
        $id8 = new UserId("9");
        $id9 = new UserId("10");

        $email = new Email("dragana@uns.com");
        $email2 = new Email("emilija@uns.com");
        $email3 = new Email("milos@uns.com");
        $email4 = new Email("sasa@uns.com");
        $email5 = new Email("nikola@uns.com");
        $email6 = new Email("slavica@uns.com");
        $email7 = new Email("ruzica@uns.com");
        $email8 = new Email("pantelija@uns.com");
        $email9 = new Email("svetislav@uns.com");
        $email10 = new Email("gojko@uns.com");

        $user = new User($id, $email);
        $user2 = new User($id1, $email2);
        $user3 = new User($id2, $email3);
        $user4 = new User($id3, $email4);
        $user5 = new User($id4, $email5);
        $user6 = new User($id5, $email6);
        $user7 = new User($id6, $email7);
        $user8 = new User($id7, $email8);
        $user9 = new User($id8, $email9);
        $user10 = new User($id9, $email10);

        $this->users = [$user, $user2, $user3, $user4, $user5, $user6, $user7, $user8, $user9, $user10];
        return $this->users;
    }
}
