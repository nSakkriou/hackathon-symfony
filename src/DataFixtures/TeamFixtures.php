<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $team = new Team();
            $team->setName($faker->company);

            $manager->persist($team);
            // Add reference for easy access in other fixtures
            $this->addReference('team_' . ($i + 1), $team);
        }

        $manager->flush();
    }
}
