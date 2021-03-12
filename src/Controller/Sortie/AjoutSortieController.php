<?php

namespace App\Controller\Sortie;

use App\Entity\Sortie;
use App\Form\Sortie\AjoutSortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjoutSortieController extends AbstractController
{
    /**
     * @Route("/sortie/ajout", name="ajoutSortie")
     */
    public function index(Request $request): Response
    {

        $user = new Sortie();
        $form = $this->createForm(AjoutSortieType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('sortie/ajoutSortie.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
