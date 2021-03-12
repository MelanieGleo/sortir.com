<?php

namespace App\Controller\Profil;

use App\Entity\Site;
use App\Entity\Sortie;
use App\Form\Profil\ModifierFormType;
use claviska\SimpleImage;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProfilController extends AbstractController
{

    /**
     * @Route("/", name="app_index")
     */
    public function Accueil(): Response
    {
        $repoSites = $this->getDoctrine()->getRepository(Site::class);
        $sites = $repoSites->findAll();
        $repoSortie = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $repoSortie->findAll();

        return $this->render('sortie/sortie.html.twig',[
            'sites' => $sites,
            'sorties' => $sortie
        ]);
    }




    /**
     * @Route("/profil/modifier", name="app_modifier")
     * @param EntityManagerInterface $entityManager
     * @param string $uploadDir
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @throws Exception
     */

    //UploadDir est défini dans config/services.yaml
    public function modifier(EntityManagerInterface $entityManager, string $uploadDir, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $repoSites = $this->getDoctrine()->getRepository(Site::class);
        $sites = $repoSites->findAll();

        $participant = $this->getUser();
        //crée le formulaire en lui passant l'instance
        $profilForm = $this->createForm(ModifierFormType::class, $participant

        );
        //traitement des données
        $profilForm->handleRequest($request);

        //Traitement upload des photos
        if ($profilForm->isSubmitted() && $profilForm->isValid()) {

            //on recupere la saisie du formulaire
            $participant = $profilForm->getData();

            // on reprend le mot de passe d'avant
            if ($participant->getMotDePasse() == "") {
                $participant->setMotDePasse($this->getUser()->getPassword());
            }

            //Modification du mot de passe
            if (!empty($profilForm->get('plainPassword')->getData())) {

                // Encode the plain password, and set it.
                $encodedPassword = $passwordEncoder->encodePassword(
                    $this->getUser(),
                    $profilForm->get('plainPassword')->getData()
                );
                    $participant->setMotDePasse($encodedPassword);
            }
            //on récupère l'image uploadée
            /** @var UploadedFile $photo */
            $photo = $profilForm->get('photo')->getData();

            if ($photo) {
                //génère un nom de fichier aléatoire, avec la bonne extension
                $newFilename = md5(uniqid()) . "." . $photo->guessExtension();

                //déplace le fichier uploadé dans public/images/photoParticipant
                $photo->move($uploadDir, $newFilename);

                //hydrate la propriété de notre entité avec le nom du fichier
                $participant->setEmplacementPhoto($newFilename);


                //à installer depuis https://github.com/claviska/SimpleImage/
                //pour redimensionner les images (ou autres filtres !)
                $image = new SimpleImage();
                //cible l'image à redimensionner
                $image->fromFile($uploadDir . $newFilename)
                    //redimensionne au plus grand dans un carré de 200 x 200
                    ->bestFit(200, 200)
                    //sauvegarde dans un répertoire de public/
                    ->toFile($uploadDir . "small/" . $newFilename);
            }

            //insertion en base
            $entityManager->flush();

            //crée un message en session pour l'afficher sur la prochaine page
            $this->addFlash('success', 'Votre profil a bien été modifier');

            return $this->redirectToRoute('app_profil');
        }
        $this->addFlash('error', "Votre profil n'a pas pu etre modifier");
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
        return $this->render('profil/afficherProfil.html.twig');
    }
}
