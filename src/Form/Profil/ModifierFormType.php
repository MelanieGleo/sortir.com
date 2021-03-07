<?php

namespace App\Form\Profil;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', null,[
                "label" => "Pseudo"
            ])
            ->add('prenom', null,[
                "label" => "Prénom"
            ])
            ->add('nom', null,[
                "label" => "Nom"
            ])
            ->add('telephone', null,[
                "label" => "Téléphone"
            ])
            ->add('mail', EmailType::class,[
                "label" => "Email"
            ])
            ->add('motDePasse', PasswordType::class,[
                "label" => "Mot de passe"
            ])

//            todo nouveau mot de passe
//            TODO confirmation mdp
//            ->add('site')
//            TODO upload photo

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
