<?php

namespace App\Service;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploadService
{

    public function __construct(
        private SluggerInterface $slugger,
        private ParameterBagInterface $parameterBag,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function upload(UploadedFile $uploadedFile)
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
        $destination = $this->parameterBag->get('kernel.project_dir').'/public/uploads';
        $path = $destination . '/' . $newFilename;

        // Move the file to the directory where uploads are stored
        try {
            $uploadedFile->move(
                $destination,
                $newFilename
            );

            $fileEntity = new File();
            $fileEntity->setName($safeFilename);
            $fileEntity->setPath($path);


            $this->entityManager->persist($fileEntity);

        } catch (FileException $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $fileEntity;
    }
}
