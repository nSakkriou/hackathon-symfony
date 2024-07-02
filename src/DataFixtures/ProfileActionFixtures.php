<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\ProfileAction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProfileActionFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $profileAction = new ProfileAction();
            // Assuming you have users, profiles, and action types already created, get random references
            $profileAction->setUserId($this->getReference('user_' . $faker->numberBetween(1, 5))); // Adjust number range based on actual user references
            $profileAction->setProfile($this->getReference('profile_' . $faker->numberBetween(1, 10))); // Adjust number range based on actual profile references
            $profileAction->setActionType($this->getReference('action_type_' . $faker->numberBetween(1, 7))); // Adjust number range based on actual action type references
            $profileAction->setCreatedAt(new \DateTimeImmutable($faker->dateTimeThisYear->format('Y-m-d')));

            $manager->persist($profileAction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProfileFixtures::class,
            UserFixtures::class,
            ActionTypeFixtures::class
        ];
    }
}
