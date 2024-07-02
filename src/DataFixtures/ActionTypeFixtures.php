<?php

namespace App\DataFixtures;

use App\Entity\ActionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActionTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $actions = [
            [
                "name" => "NO GO",
                "points" => 0
            ],
            [
                "name" => "GO",
                "points" => 1,
            ],
            [
                "name" => "Bonus Challenge",
                "points" => 3,
            ],
            [
                "name" => "Préqualification téléphonique",
                "points" => 2,
            ],
            [
                "name" => "Entretien RH",
                "points" => 2,
            ],
            [
                "name" => "Entretien Manager",
                "points" => 3,
            ],
            [
                "name" => "Candidat Recruté",
                "points" => 5,
            ]
        ];

        foreach($actions as $index => $action) {
            $actionType = new ActionType();
            $actionType->setName($action['name']);
            $actionType->setPoints($action['points']);

            $this->addReference('action_type_'. $index +1 , $actionType);

            $manager->persist($actionType);
        }

        $manager->flush();
    }
}
