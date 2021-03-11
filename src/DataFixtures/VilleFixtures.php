<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ville = new ville();

        $ville->setCodePostal('44000');
        $ville->setNomVille('Nantes');

        $manager->persist($ville);

        $ville2 = new ville();

        $ville2->setCodePostal('29900');
        $ville2->setNomVille('Quimper');

        $manager->persist($ville2);

        $ville3 = new ville();

        $ville3->setCodePostal('35000');
        $ville3->setNomVille('Rennes');

        $manager->persist($ville3);

        $manager->flush();
    }
}

