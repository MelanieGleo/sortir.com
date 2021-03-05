<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModifierProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', null, [
                "label" => "Pseudo"
            ])
            ->add('prenom', null, [
                "label" => "Prénom"
            ])
            ->add('nom', null, [
                "label" => "Nom"
            ])
            ->add('telephone', null, [
                "label" => "Téléphone"
            ])
            ->add('mail', EmailType::class, [
                "label" => "Email"
            ])
            ->add('motDePasse', PasswordType::class, [
                'label' => "Mot de passe",
                'required'    => true,
                'constraints' => [
                    new NotBlank([
                    'message' => "Saisissez votre ancien mot de passe",
                  ]),
                ]])
//            -> add()

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
