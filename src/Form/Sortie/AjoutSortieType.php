<?php

namespace App\Form\Sortie;

use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Site;
use App\Entity\Sortie;
use App\Entity\Lieu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class AjoutSortieType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('participOrga', EntityType::class, [
                "label" => "Organisateur : ",
                'class' => Participant::class,
                'choice_label' => function ($participant) {
                    return $participant->getNom();
                }
            ])
            ->add('site', EntityType::class, [
                "label" => "Site ENI : ",
                'class' => Site::class,
                'choice_label' => function ($site) {
                    return $site->getNomSite();
                }
            ])
            ->add('Etat', EntityType::class, [
                "label" => "Etat : ",
                'class' => Etat::class,
                'choice_label' => function ($etat) {
                    return $etat->getLibelle();
                }
            ])
            ->add('Lieu', TextType::class, [
                "label" => "Lieu : ",

            ])

            ->add('nom', TextType::class, [
                "label" => "Nom de la sortie : "
            ])

            ->add('dateHeureDebut', DateTimeType::class, [
                "label" => "Heure de début : "
            ])

            ->add('duree', IntegerType::class, [
                "label" => "Durée: "
            ])

            ->add('dateLimitInscription', DateTimeType::class, [
                "label" => "Date limite d'inscription: "
            ])

            ->add('nbInscriptionsMax', IntegerType::class, [
                "label" => "Nombre de place : "
            ])

            ->add('infosSortie', TextType::class, [
                "label" => "Description et infos :"
            ])

            ->add('submit', SubmitType::class, [
                "label" => $options['btn_text'],
                //TODO styliser bouton
                "attr" => ['class' => 'btn']
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
            'btn_text' => 'Valider'
        ]);
    }
}
