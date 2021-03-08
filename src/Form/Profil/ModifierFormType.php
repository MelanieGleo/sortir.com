<?php

namespace App\Form\Profil;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'New password',
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                ],
                'invalid_message' => 'The password fields must match.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            //  Todo          ->add('site')
            //            TODO upload photo a adapter a notre besoin
//            ->add('picture', FileType::class, [
//                'mapped' => false,
//                'constraints' => [
//                    //contrainte de validation spécifique pour les images
//                    //https://symfony.com/doc/current/reference/constraints/Image.html
//                    new Image([
//                        'maxSize' => '8M',
//                        'maxSizeMessage' => 'too big!'
//                    ])
//                ]
//            ])





        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
