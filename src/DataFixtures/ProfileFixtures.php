<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProfileFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $profile = new Profile();
            $profile->setFirstname($faker->firstName);
            $profile->setLastname($faker->lastName);
            $profile->setPhone('0000000000');
            $profile->setEmail($faker->email);
            $profile->setAcquaintancePro($faker->boolean);
            $profile->setLinkedin($faker->url);

            // Assuming you have users and profile statuses already created, get random references
            $profile->setCooptedBy($this->getReference('user_' . $faker->numberBetween(1, 5))); // Adjust number range based on actual user references
            $profile->setStatus($this->getReference('status_' . $faker->numberBetween(1, 3))); // Adjust number range based on actual status references

            $this->addReference('profile_' . ($i + 1), $profile);

            $manager->persist($profile);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ProfileStatusFixtures::class
        ];
    }
}
