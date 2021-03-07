<?php

namespace App\Controller\Profil;

use App\Entity\Participant;
use App\Form\Profil\ModifierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class ProfilController extends AbstractController
{

    /**
     * @Route("/", name="app_index")
     */
    public function Accueil(): Response
    {
        return $this->render('index.html.twig');
    }


    /**
     * @Route("/profil/modifier", name="app_modifier")
     * @param Request $request
     * @return Response
     */
    public function modifier(Request $request): Response
    {
        $participant = new Participant();

        $profilForm = $this->createForm(ModifierType::class, $participant);
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

    /**
     * @Route("/profil", name="app_profil")
     * @return Response
     */
    public function afficherProfil(): Response
    {
        $user = $this->getUser();
        if (!$user)
            throw new NotFoundHttpException('profil not found');
        return $this->render('profil/afficherProfil.html.twig', [
            'profil' => $user]);
    }
}
