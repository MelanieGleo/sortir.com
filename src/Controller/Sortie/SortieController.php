<?php

namespace App\Controller\Sortie;

use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="app_sortie")
     */
    public function sortie(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repo->InfosSorties();
        return $this->render('sortie/sortie.html.twig', ['sorties'=>$sorties]);
    }

    /**
     * @Route("/sortie/{id}", name="detailSortie", requirements={"id":"\d+"})
     */
    public function detailSortie($id): Response
    {

        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        //$sortie = $repo->find($id);
        $sortie = $repo->detailSorties($id);
        return $this->render('sortie/detailSortie.html.twig', ['sortie'=>$sortie]);
    }
}
