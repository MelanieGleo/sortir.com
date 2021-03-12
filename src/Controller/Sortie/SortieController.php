<?php

namespace App\Controller\Sortie;

use App\Entity\Participant;
use App\Entity\Sortie;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/", name="app_sortie")
     *
     **/

    public function sortie(SiteRepository $siteRepo, Request $request): Response
    {
        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        $sites = $siteRepo->findAll();

        //filtres
        $filters = $request->get("sites");
        //filters est null de base dans infossorties
        $sorties = $repo->InfosSorties($filters);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('sortie/_contentSortie.html.twig', ['sorties' => $sorties])
            ]);
        }

        return $this->render('sortie/sortie.html.twig', ['sorties' => $sorties, 'sites' => $sites]);
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
    public function inscriptionSortie(SiteRepository $siteRepo, $sortieID, EntityManagerInterface $em, Request $request): Response
    {
        $participant = $this->getUser();
        $sortie = $em->getRepository('App:Sortie')
            ->findOneBy(['id' => $sortieID]);
        $participant->addSortie($sortie);
        $em->persist($participant);
        $em->flush();

        $repo = $this->getDoctrine()->getRepository(Sortie::class);
        $sites = $siteRepo->findAll();

        //filtres
        $filters = $request->get("sites");

        $sorties = $repo->InfosSorties($filters);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('sortie/_contentSortie.html.twig', ['sorties' => $sorties])
            ]);
        }

        return $this->render('sortie/sortie.html.twig', ['sorties' => $sorties, 'sites' => $sites]);
    }
}
