<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Site;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AfficherProfilController extends AbstractController
{

    /**
     * @Route("/profil", name="AP")
     */
    public function afficherProfil(ParticipantRepository $participantRepository): Response
    {
        $user = $this->getUser();
        if(!$user)
            throw new NotFoundHttpException('profil not found');
        return $this->render('profil/afficherProfil.html.twig' ,['profil' => $user]);
    }


    /**
     * @Route("/accueil", name="Accueil")
     */
    public function Accueil(): Response
    {
        return $this->render('profil/accueil.html.twig');
    }

}
