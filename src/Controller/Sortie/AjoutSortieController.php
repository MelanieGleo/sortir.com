<?php

namespace App\Controller\Sortie;

use App\Entity\Sortie;
use App\Form\Sortie\AjoutSortieType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjoutSortieController extends AbstractController
{
    /**
     * @Route("/sortie/ajout", name="app_ajoutSortie")
     * @param Request $request
     * @param EntityManager $entityManager
     * @return Response
     */
    public function index(Request $request,EntityManager $entityManager): Response
    {

        $user = new Sortie();
        $form = $this->createForm(AjoutSortieType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render(sortie/sortie.html.twig, [
            'registrationForm' => $form->createView(),
        ]);
    }
}
