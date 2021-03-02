<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifierProfilController extends AbstractController
{
    /**
     * @Route("/modifier/profil", name="modifier_profil")
     */
    public function index(): Response
    {
        return $this->render('profil/modifierProfil.html.twig', [
            'controller_name' => 'ModifierProfilController',
        ]);
    }
}
