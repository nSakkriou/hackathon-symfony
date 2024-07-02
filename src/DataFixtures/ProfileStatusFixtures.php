<?php

namespace App\DataFixtures;

use App\Entity\ProfileStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $statuses = [
            'Préqual Tél',
            'Entretien RH',
            'Entretien Manager',
            'Vivier',
            'Candidat Recruté',
            'Candidat non retenu'
        ];

        foreach ($statuses as $index => $statusName) {
            $profileStatus = new ProfileStatus();
            $profileStatus->setName($statusName);
            $profileStatus->setOrderStep($index);

            $manager->persist($profileStatus);
            // Add reference for easy access in other fixtures
            $this->addReference('status_' . $index + 1, $profileStatus);
        }

        $manager->flush();
    }
}
