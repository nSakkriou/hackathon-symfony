<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@example.com');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'password')); // Example password hashing, replace with your logic
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setPhone('0000000000');

            // Assuming you have teams already created, get random team reference
            $user->setTeam($this->getReference('team_' . $faker->numberBetween(1, 3))); // Adjust number range based on actual team references

            $manager->persist($user);
            // Add reference for easy access in other fixtures
            $this->addReference('user_' . ($i + 1), $user);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TeamFixtures::class,
        ];
    }
}
