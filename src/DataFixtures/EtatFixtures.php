<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatFixtures extends Fixture
{
//    const enCours_Reference = 'en cours';
//    const termine_Reference = 'terminé';
//    const annule_Reference = 'annulé';

    public function load(ObjectManager $manager)
    {
        $enCours = New Etat();

        $enCours->setLibelle('en cours');
        $manager->persist($enCours);

        $termine = New Etat();

        $termine->setLibelle('terminé');
        $manager->persist($termine);

        $annule = New Etat();

        $annule->setLibelle('annulé');
        $manager->persist($annule);

        $manager->flush();

//        $this->addReference(self::enCours_Reference, $enCours );
//        $this->addReference(self::termine_Reference, $termine );
//        $this->addReference(self::annule_Reference, $annule );
    }
}
