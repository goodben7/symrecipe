<?php

namespace App\DataFixtures;

use App\Entity\CoteL1Genie;
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
        //Etudiant 
        $etdudaints = [];
        for ($i=0; $i < 10 ; $i++) { 
            $etdudaint = new EtudiantL1Genie (); 
            $etdudaint->setNom($this->faker->firstName($gender = 'male'|'female'))
                ->setPostnom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setSexe($this->faker->randomElement(['M', 'F']));

            $etdudaints[] = $etdudaint; 
            $manager->persist($etdudaint);
        }


        //cote 
        for ($j=0; $j < 10 ; $j++) { 
            $cote = new CoteL1Genie(); 
            $cote->setEtudiant($etdudaints[$j])
                ->setTp1($this->faker->randomElement(['2','5', '10', '15', '16']))
                ->setTp2($this->faker->randomElement(['1','2','5', '10', '15', '16']));
            $manager->persist($cote);
        }
        
        $manager->flush();
    }
}
