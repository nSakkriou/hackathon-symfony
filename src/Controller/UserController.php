<?php

namespace App\Controller;

use App\Service\HomeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    public function __construct(private readonly Security $security, private HomeService $homeService)
    {
    }

    #[Route('/api/myprofile', name: 'my_profile')]
    public function index(): Response
    {
        return new JsonResponse([
            'id' => $this->security->getToken()->getUser()->getId(),
            'teamId' => $this->security->getToken()->getUser()->getTeam()->getId()
        ], 200, []);
    }

    #[Route('/api/rankings', name: 'rankings')]
    public function rankings(): Response
    {
        return new JsonResponse([
            'rankings' => $this->homeService->getRankings(),
        ]);
    }
}
