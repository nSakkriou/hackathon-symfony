<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    public function __construct(private readonly Security $security)
    {
    }

    #[Route('/api/myprofile', name: 'app_user')]
    public function index(): Response
    {
        return new JsonResponse([
            'id' => $this->security->getToken()->getUser()->getId(),
        ], 200, []);
    }
}
