<?php

namespace App\Controller;

use App\Repository\PopUpMessageRepository;
use App\Repository\ProfileRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    public function __construct(private TeamRepository $teamRepository, )
    {
    }

    #[Route('/api/home', name: 'home')]
    public function index(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        PopUpMessageRepository $popUpMessageRepository,
        ProfileRepository $profileRepository): Response
    {
        $users = $userRepository->findAll();
        $serializedUsers = $serializer->serialize($users, 'json', ['groups' => 'user:read']);

        $profiles = $profileRepository->findAll();
        $serializedProfiles = $serializer->serialize($profiles, 'json', ['groups' => 'profile:read']);

        return new JsonResponse([
            'users' => json_decode($serializedUsers, true),
            'profiles' => json_decode($serializedProfiles, true),
            'ranking' => $userRepository->findPointsByUser(),
            'teamRanking' => $this->teamRepository->findPointsByTeam(),
            'popUpMessage' => $popUpMessageRepository->findLatestActiveMessage()
        ], 200, []);
    }

    #[Route('/api/admin', name: 'admin')]
    public function admin()
    {
        $teams = $this->teamRepository->findAll();

        return new JsonResponse([

        ])
    }
}
