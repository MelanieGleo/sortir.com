<?php

namespace App\Controller\Sortie;

use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/sortie", name="sortie")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repo->InfosSorties();
        return $this->render('sortie/sortie.html.twig', ['sorties'=>$sorties]);
    }
}
