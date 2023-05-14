<?php

namespace App\DataFixtures;

use App\Entity\EtudiantL1Genie;
use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private Generator $faker; 

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR'); 
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 50 ; $i++) { 
            $etdudaint = new EtudiantL1Genie (); 
            $etdudaint->setNom($this->faker->firstName($gender = 'male'|'female'))
            ->setPostnom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setSexe($this->faker->randomElement(['M', 'F']));
            $manager->persist($etdudaint);
        }
        $manager->flush();
    }
}
