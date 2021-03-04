<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ModifierProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/modifier", name="modifier_profil")
     * @param Request $request
     * @return Response
     */
    public function modifier(Request $request): Response
    {
        $participant = new Participant();

        $profilForm = $this->createForm(ModifierProfilType::class, $participant);
        $profilForm->handleRequest($request);

//        if($form -> isSubmitted() & $form->isValid()){
//            //Todo encode new password
//            dump($participant);
//
//        }


        return $this->render('profil/modifierProfil.html.twig', [
            "modifier_profil_form" => $profilForm->createView()
        ]);
    }
}
