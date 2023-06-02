<?php

namespace App\DataFixtures;

use App\Entity\CoteL1Genie;
use App\Entity\EtudiantL1Genie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker; 
    
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR'); 
    }
    public function load(ObjectManager $manager): void
    {
        //user
        $users = [];
        for ($k=0; $k < 5 ; $k++) { 
            $user = new User(); 
            $user->setNom($this->faker->firstName($gender = 'male'|'female'))
                ->setPostnom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setSexe($this->faker->randomElement(['M', 'F']))
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $users [] = $user;
            $manager->persist($user);
            
        }

        //Etudiant 
        $etdudaints = [];
        for ($i=0; $i < 10 ; $i++) { 
            $etdudaint = new EtudiantL1Genie (); 
            $etdudaint->setNom($this->faker->firstName($gender = 'male'|'female'))
                ->setPostnom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setSexe($this->faker->randomElement(['M', 'F']))
                ->setUser($users[mt_rand(0, count($users)-1)]);

            $etdudaints[] = $etdudaint; 
            $manager->persist($etdudaint);
        }


        //cote 
        for ($j=0; $j < 10 ; $j++) { 
            $cote = new CoteL1Genie(); 
            $cote->setEtudiant($etdudaints[$j])
                ->setTp1($this->faker->randomElement(['2','5', '10', '15', '16']))
                ->setTp2($this->faker->randomElement(['1','2','5', '10', '15', '16']))
                ->setUser($users[mt_rand(0, count($users)-1)]);
            $manager->persist($cote);
        }
        
        $manager->flush();
    }
}
