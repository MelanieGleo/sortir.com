<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Site;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherProfilController extends AbstractController
{

    /**
     * @Route("/profil", name="AP")
     */
    public function afficherProfil(ParticipantRepository $participantRepository): Response
    {
        $id = 2;
        $profil = $participantRepository->InfosProfil($id);
        if(!$profil)
            throw new NotFoundHttpException('Profil not found');
        return $this->render('profil/AfficherProfil.html.twig' ,['profils' => $profil]);
    }


    /**
     * @Route("/accueil", name="Accueil")
     */
    public function Accueil(): Response
    {
        return $this->render('profil/Accueil.html.twig');
    }
}
