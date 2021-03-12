<?php

namespace App\DataFixtures;

use App\Entity\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;

class SiteFixtures extends Fixture
{


    const siteNantes_Reference = 'Nantes';
    const siteRennes_Reference = 'Rennes';
    const siteQuimper_Reference = 'Quimper';

    public function load(ObjectManager $manager)
    {
        $siteNantes = new Site();
        $siteNantes->setNomSite('Nantes');
        $manager->persist($siteNantes);

        $siteRennes = new Site();
        $siteRennes->setNomSite('Rennes');
        $manager->persist($siteRennes);

        $siteQuimper = new Site();
        $siteQuimper ->setNomSite('Quimper');
        $manager->persist($siteQuimper);

        $manager->flush();

        $this->addReference(self::siteNantes_Reference, $siteNantes);
        $this->addReference(self::siteRennes_Reference, $siteRennes);
        $this->addReference(self::siteQuimper_Reference, $siteQuimper);
    }



}
