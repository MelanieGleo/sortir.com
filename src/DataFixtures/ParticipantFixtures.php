<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
    $participant = New Participant();

     $participant->setPseudo('Marine');
     $participant->setPrenom('Marine');
     $participant->setNom('Baudin');
     $participant->setTelephone('0630254555');
     $participant->setMail('marine@marine.com');
     $participant->setAdministrateur(false);
     $participant->setSite($this->getReference(SiteFixtures::siteQuimper_Reference));
     $participant->setActif(true);

     $participant->setMotDePasse(($this->passwordEncoder->encodePassword(
         $participant,
         'marine'
     )));
     $manager->persist($participant);

    $participant2 = New Participant();

    $participant2->setPseudo('JB');
    $participant2->setPrenom('Jean-Baptise');
    $participant2->setNom('Ponnet');
    $participant2->setTelephone('0630254556');
    $participant2->setMail('jb@jb.com');
    $participant2->setAdministrateur(false);
    $participant2->setSite($this->getReference(SiteFixtures::siteRennes_Reference));
    $participant2->setActif(false);
    $participant2->setMotDePasse(($this->passwordEncoder->encodePassword(
        $participant2,
        'jeanbon'
    )));
    $manager->persist($participant2);

    $participant3 = New Participant();

    $participant3->setPseudo('Melanie');
    $participant3->setPrenom('Melanie');
    $participant3->setNom('Gleonec');
    $participant3->setTelephone('0630254555');
    $participant3->setMail('melanie@melanie.com');
    $participant3->setAdministrateur(true);
    $participant3->setSite($this->getReference(SiteFixtures::siteNantes_Reference));
    $participant3->setActif(true);
    $participant3->setMotDePasse(($this->passwordEncoder->encodePassword(
        $participant3,
        'melanie'
    )));
    $manager->persist($participant3);

    $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SiteFixtures::class,

        ];
    }
}
