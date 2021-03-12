<?php

namespace App\Form\Sortie;

use App\Entity\Sortie;
use Doctrine\DBAL\Types\IntegerType;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('participOrga',TextType::class, [
                "label" => "Participants"
            ])
            ->add('site', TextType::class, [
                "label" => "Nom site"
            ])
            ->add('Etat', TextType::class, [
                "label" => "Etat"
            ])
            ->add('Lieu', TextType::class, [
                "label" => "Lieu"
            ])
            ->add('nom', TextType::class, [
                "label" => "Nom"
            ])
            ->add('dateHeureDebut',TextType::class, /*date("a", 1)*/ [
                "label" => "Heure de début"
            ])
            ->add('duree', TextType::class, [
                "label" => "Participants"
            ])
            ->add('dateLimitInscription', TextType::class /*date("YYYY - MM - DD", 1)*/)
            ->add('nbInscriptionsMax', TextType::class, [
                "label" => "Lieu"
            ])
            ->add('infosSortie', TextType::class, [
                "label" => "Nom"
            ])
            ->add('urlPhoto', TextType::class, [
                "label" => "Nom"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
