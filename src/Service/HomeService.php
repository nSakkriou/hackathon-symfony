<?php

namespace App\Service;

use App\Repository\ProfileRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;

class HomeService
{
    public function __construct(
        private UserRepository $userRepository,
        private TeamRepository $teamRepository,
        private SerializerInterface $serializer,
        private ProfileRepository $profileRepository,
    )
    {
    }

    public function getRankings(): array
    {
        return [
            'individualRanking' => $this->userRepository->findPointsByUser(),
            'teamRanking' => $this->teamRepository->findPointsByTeam(),
        ];
    }

    public function getEntitiesFromRepoAndGroup($entities, $group)
    {
        $serializedEntities = $this->serializer->serialize($entities, 'json', ['groups' => $group]);

        return json_decode($serializedEntities, true);
    }
}
