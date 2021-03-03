<?php

namespace App\Controller;

use App\Entity\Participant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherProfilController extends AbstractController
{

    /**
     * @Route("/profil", name="AP")
     */
    public function afficherProfil(): Response
    {
        $id = 2;
        $repo = $this->getDoctrine()->getRepository(Participant::class);
        $profil = $repo->find($id);
        if(!$profil)
            throw new NotFoundHttpException('Profil not found');
        return $this->render('afficher_profil/AfficherProfil.html.twig' ,['profil' => $profil]);
    }


    /**
     * @Route("/Accueil", name="Accueil")
     */
    public function Accueil(): Response
    {
        return $this->render('afficher_profil/Accueil.html.twig');
    }
}
