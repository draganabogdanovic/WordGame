<?php

namespace App\Application;

use App\Domain\Email\Exception\EmailLoginException;
use App\Domain\Email\Model\Email;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class UserEmailLoginService
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var JWTTokenManagerInterface $JWTTokenManager
     */
    private JWTTokenManagerInterface $JWTTokenManager;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, JWTTokenManagerInterface $JWTTokenManager)
    {
        $this->JWTTokenManager = $JWTTokenManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $userEmail
     *
     * @return string
     *
     * @throws EmailLoginException
     */
    public function execute(string $userEmail): string
    {
        $userEmail = new Email($userEmail);
        $user = $this->userRepository->findUserByEmail($userEmail);
        if(!$user) {
            throw new EmailLoginException();
        }

        $JWTTokenManager = $this->JWTTokenManager;
        return $JWTTokenManager->create($user);
    }
}
