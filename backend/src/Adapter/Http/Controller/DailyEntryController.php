<?php

namespace App\Adapter\Http\Controller;

use App\Application\DailyEntryService;
use App\Domain\DailyEntry\Exception\DailyEntryWordException;
use App\Domain\DailyEntry\Exception\TodayDailyEntryWordException;
use App\Domain\Word\Exception\WordFormatException;
use App\Domain\Word\Exception\WordIsNotInTheDictionaryException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;


#[Route('api/entry', name: 'daily_entry_class')]
class DailyEntryController
{
    /**
     * @var DailyEntryService $dailyEntryService
     */
    public DailyEntryService $dailyEntryService;

    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * @param DailyEntryService $dailyEntryService
     * @param Security $security
     */
    public function __construct(DailyEntryService $dailyEntryService, Security $security)
    {
        $this->dailyEntryService = $dailyEntryService;
        $this->security = $security;
    }

    #[Route('/user_words', methods: ['GET'])]
    public function getAllWordsForUser(): JsonResponse
    {
        try {
            $userId = $this->security->getUser()->getUserIdentifier();
            $words = $this->dailyEntryService->getWordsForUser($userId);
        } catch (DailyEntryWordException $e) {
            return new JsonResponse($e->getMessage(), 400);
        }

        return new JsonResponse($words);
    }

    #[Route('/word', methods: ['POST'])]
    public function addWordForUser(Request $request): JsonResponse
    {
        $bodyParameters = json_decode($request->getContent(), true);
        $wordParameter = $bodyParameters['word'];
        try {
            $userId = $this->security->getUser()->getUserIdentifier();
            $dailyEntry = $this->dailyEntryService->addWordForUser($wordParameter, $userId);
        } catch (TodayDailyEntryWordException | WordIsNotInTheDictionaryException | WordFormatException $e) {
            return new JsonResponse($e->getMessage(), 400);
        }

        return new JsonResponse($dailyEntry);
    }
}
