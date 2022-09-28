<?php

namespace App\Adapter\Http\Controller;

use App\Application\UserEmailLoginService;
use App\Domain\Email\Exception\EmailFormatException;
use App\Domain\Email\Exception\EmailLoginException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/login', name: 'email_login_class')]
class EmailController
{
    /**
     * @var UserEmailLoginService $emailLoginService
     */
    private UserEmailLoginService $emailLoginService;

    /**
     * @param UserEmailLoginService $userEmailLoginService
     */
    public function __construct(UserEmailLoginService $userEmailLoginService)
    {
        $this->emailLoginService = $userEmailLoginService;
    }

    #[Route('/login_user', methods: ['POST'])]
    public function loginUser(Request $request, JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        try {
            $bodyParameters = json_decode($request->getContent(), true);
            $emailParameter = $bodyParameters['email'];
            $token = $this->emailLoginService->execute($emailParameter);
        } catch (EmailLoginException | EmailFormatException $e) {
            return new JsonResponse($e->getMessage(), 400);
        }

        return new JsonResponse($token);
    }
}
