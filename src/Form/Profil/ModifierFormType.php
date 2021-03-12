<?php

namespace App\Form\Profil;

use App\Entity\Participant;

use App\Entity\Site;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;


class ModifierFormType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $repo = $this->getDoctrine()->getRepository(Site::class);
        $builder
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo"
            ])
            ->add('prenom', TextType::class, [
                "label" => "Prénom"
            ])
            ->add('nom', TextType::class, [
                "label" => "Nom"
            ])
            ->add('telephone', TelType::class, [
                "label" => "Téléphone"
            ])
            ->add('mail', EmailType::class, [
                "label" => "Email"
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmer mot de pass',
                ],
                'invalid_message' => 'Les mots de passes ne sont pas identiques.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('site', ChoiceType::class, [
                'label' => 'Site ENI'
            ])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    //contrainte de validation spécifique pour les images
                    //https://symfony.com/doc/current/reference/constraints/Image.html
                    new Image([
                        'maxSize' => '8M',
                        'maxSizeMessage' => 'too big!'
                    ])
                ]
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
            'data_class' => Participant::class,
            'btn_text' => 'Modifier'
        ]);
    }

}
