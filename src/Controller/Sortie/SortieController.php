<?php

namespace App\Controller\Sortie;

use App\Entity\Participant;
use App\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="app_sortie")
     *
     **/

    public function sortie(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repo->InfosSorties();
        return $this->render('sortie/sortie.html.twig', ['sorties' => $sorties]);
    }

    /**
     * @Route("/sortie/{id}", name="app_detailSortie", requirements={"id":"\d+"})
     */
    public function detailSortie($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        //$sortie = $repo->find($id);
        $sortie = $repo->detailSorties($id);
        return $this->render('sortie/detailSortie.html.twig', ['sortie' => $sortie]);
    }

    /**
     * @Route("/inscrire/{sortieID}", name="app_inscriptionSortie", requirements={"sortieID":"\d+"})
     */
    public function inscriptionSortie($sortieID, EntityManagerInterface $em): Response
    {
        $participant = $this->getUser();
        $sortie = $em->getRepository('App:Sortie')
            ->findOneBy(['id' => $sortieID]);
        $participant->addSortie($sortie);
        $em->persist($participant);
        $em->flush();

        return $this->render('sortie/random.html.twig');
    }
}
