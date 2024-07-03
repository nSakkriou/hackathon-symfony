<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Profile;
use App\Repository\ProfileStatusRepository;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use App\Service\FileUploadService;
use App\Service\ProfileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileController extends AbstractController
{

    #[Route('/api/profile', name: 'new_profile', methods: ['POST'])]
    public function new(
        Request $request,
        ProfileService $profileService,
        EntityManagerInterface $entityManager,
        FileUploadService $fileUploadService
    )
    {
        $profile = $profileService->newProfileFromRequest($request);

        $files = $request->files->get('files');

        if ($files) {
            foreach ($files as $uploadedFile) {
                $file = $fileUploadService->upload($uploadedFile);
                $file->setProfile($profile);
                $profile->addFile($file);
            }
            $entityManager->persist($profile);
            $entityManager->flush();
        }

        return new Response('OK', Response::HTTP_OK);
    }
}
