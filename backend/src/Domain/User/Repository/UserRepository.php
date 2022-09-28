<?php

namespace App\Domain\User\Repository;

use App\Domain\Email\Model\Email;
use App\Domain\User\Model\User;

interface UserRepository
{
    /**
     * @param Email $email
     *
     * @return null|User
     */
    function findUserByEmail(Email $email): ?User;
}
