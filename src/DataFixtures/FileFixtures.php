<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class FileFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $file = new File();
            $file->setName($faker->word);
            $file->setPath('/path/to/files/' . $faker->fileExtension);
            // Assuming you have profiles already created, get a random profile
            $file->setProfile($this->getReference('profile_' . $faker->numberBetween(1, 10))); // Adjust number range based on actual profile references

            $manager->persist($file);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProfileFixtures::class,
        ];
    }
}
