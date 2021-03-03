<?php

namespace App\Controller;

use App\Form\ModifierProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/modifier", name="modifier_profil")
     */
    public function modifier(): Response
    {
        $form = $this->createForm(ModifierProfilType::class);
        return $this->render('profil/modifierProfil.html.twig', [
            "modifier_profil_form" => $form->createView()
        ]);
    }
}
