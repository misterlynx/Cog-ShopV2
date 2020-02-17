<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('pseudonyme', TextType::class, array(
            //     'attr' => array(
            //         'placeholder' => 'Choisisez votre pseudo...',
            //         ),
            //     'label' => 'Pseudonyme:',
            //     'required' => true
            // ))

            ->add('nom', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Entrer votre nom...',
                    ),
                'label' => 'Nom:',
                'required' => true
            ))
            ->add('prenom', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Entrer votre prenom...',
                    ),
                'label' => 'Prénom:'
            ))
            // ->add('datenaissance', DateType::class, array(
            //     'widget' => 'choice',
            //     'years' => range(date('Y'), date('Y')-160),
            //     'label' => 'Date de naissance:',
            //     'required' => true,
            // ))
            ->add('codepostal', NumberType::class, array(
                'attr' => array(
                    'placeholder' => 'Entrer votre code postal...',
                    ),
                'label' => 'Code postal:'
            ))
            ->add('adresse', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Entrer votre adresse...',
                    ),
                'label' => 'Adresse:',
            ])
            ->add('ville', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Entrer votre ville...',
                ),
                'label' => 'Ville:',
            ])
            ->add('email', EmailType::class, [
                'attr' => array(
                    'placeholder' => 'Entrer votre email...',
                ),
                'label' => 'Adresse-mail:',
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' =>PasswordType::class,
                'attr' => array(
                    'placeholder' => 'Entrer votre mot de passe...',
                ),
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false,
                'label' => 'Mot de passe:',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe valide',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 12,
                    ]),
                ],
            ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'label' => 'Je valide les termes',
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'Vous devez accepté nos termes pour vous inscrire.',
            //         ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }

}


