<?php

namespace App\Controller;

use App\Repository\PopUpMessageRepository;
use App\Repository\ProfileRepository;
use App\Repository\ProfileStatusRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Service\HomeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private HomeService $homeService,
        private TeamRepository $teamRepository,
        private ProfileRepository $profileRepository,
        private ProfileStatusRepository $profileStatusRepository,
        private PopUpMessageRepository $popUpMessageRepository,
    )
    {
    }

    #[Route('/api/home', name: 'home')]
    public function index(): Response
    {
        return new JsonResponse([
            'profiles' => $this->homeService->getEntitiesFromRepoAndGroup(
                $this->profileRepository->findAll(),
                'profile:read'
            ),
            'orderStepMax' => $this->profileStatusRepository->findBy(
                [],['orderStep' => 'DESC'],1
            )[0]->getOrderStep()+1,
            'rankings' => $this->homeService->getRankings(),
            'popUpMessage' => $this->popUpMessageRepository->findLatestActiveMessage()
        ], 200, []);
    }

    #[Route('/api/admin', name: 'admin')]
    public function admin(UserRepository $userRepository): Response
    {
        return new JsonResponse([
            'users' => $this->homeService->getEntitiesFromRepoAndGroup(
                $userRepository->findAll(),
                'user:read'
            ),
            'teams' => $this->homeService->getEntitiesFromRepoAndGroup(
                $this->teamRepository->findAll(),
                'team:read'
            ),
            'profiles' => $this->homeService->getEntitiesFromRepoAndGroup(
                $this->profileRepository->findAll(),
                'profile:read'
            ),
            'orderStepMax' => $this->profileStatusRepository->findBy(
                [],['orderStep' => 'DESC'],1
            )[0]->getOrderStep()+1,
            'rankings' => $this->homeService->getRankings(),
            'popUpMessage' => $this->popUpMessageRepository->findLatestActiveMessage()
        ]);
    }
}
