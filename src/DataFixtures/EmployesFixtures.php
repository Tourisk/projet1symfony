<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Employes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++)
        {
            $employes=new Employes;

            $employes   ->setPrenom("Prenom n°$i")
                                ->setNom("Nom n°$i")
                                ->setTelephone("0123456789")
                                ->setEmail("Email n°$i")
                                ->setAdresse("Adresse n°$i")
                                ->setPoste("Poste n°$i")
                                ->setSalaire("Salaire n°$i")
                                ->setDatedenaissance(new DateTime); 
            $manager->persist($employes); 
        }
        $manager->flush(); 
    }
}
