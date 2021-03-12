<?php

namespace App\Controller\Sortie;

use App\Entity\Sortie;
use App\Form\Sortie\AjoutSortieType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function ajoutSortie(Request $request, EntityManagerInterface $entityManager): Response
    {

        $ajoutSortie = new Sortie();
        $ajouterSortieForm = $this->createForm(AjoutSortieType::class, $ajoutSortie);
        $ajouterSortieForm->handleRequest($request);

        if ($ajouterSortieForm->isSubmitted() && $ajouterSortieForm->isValid()) {


            $entityManager->persist($ajoutSortie);

            $entityManager->flush();
            return $this->redirectToRoute('app_sortie');
        }


        return $this->render('sortie/ajoutSortie.html.twig', [
            "ajout_sortie" => $ajouterSortieForm->createView()
        ]);
    }
}
