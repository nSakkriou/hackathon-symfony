<?php

namespace App\Service;

use App\Entity\Profile;
use App\Repository\ProfileStatusRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class ProfileService
{
    public function __construct(
        private UserRepository $userRepository,
        private ProfileStatusRepository $profileStatusRepository)
    {
    }

    public function newProfileFromRequest(Request $request): Profile
    {
        $profile = new Profile();
        $profile->setFirstname($request->request->get('firstname'));
        $profile->setLastname($request->request->get('lastname'));
        $profile->setEmail($request->request->get('email'));
        $profile->setPhone($request->request->get('phone'));
        $profile->setAcquaintancePro($request->request->get('acquaintancePro'));
        $profile->setLinkedin($request->request->get('linkedin'));
        $profile->setCooptedBy(
            $this->userRepository->findOneBy([
                'id' => $request->request->get('cooptedBy')
            ])
        );

        $profile->setStatus(
            $this->profileStatusRepository->findBy([],['orderStep' => 'ASC'], 1)[0]
        );

        return $profile;
    }
}
