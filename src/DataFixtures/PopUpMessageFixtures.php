<?php

namespace App\DataFixtures;

use App\Entity\PopUpMessage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PopUpMessageFixtures extends Fixture
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $popUpMessage = new PopUpMessage();
            $popUpMessage->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true));
            $popUpMessage->setMessageText($faker->paragraph);
            $popUpMessage->setStartedAt(new \DateTimeImmutable($faker->dateTimeThisYear->format('Y-m-d')));
            $popUpMessage->setEndedAt(new \DateTimeImmutable($faker->dateTimeThisYear->format('Y-m-d')));

            $manager->persist($popUpMessage);
        }

        $manager->flush();
    }
}
