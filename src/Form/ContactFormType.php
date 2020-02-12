<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('sujet',TextType::class, [
                'attr' => array(
                    'placeholder' => 'Entrer le sujet de votre message...',
                ),
                'label' => 'Sujet:',
            ])
            ->add('email', EmailType::class, [
                'attr' => array(
                    'placeholder' => 'Entrer votre email...',
                ),
                'label' => 'Adresse-mail:',
                'required' => true,
            ])
            ->add('message',TextareaType::class, [
                'attr' => array(
                    'placeholder' => 'Entrer le sujet de votre message...',
                ),
                'label' => 'Message:',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer',
                'row_attr' => [
                    'class' => 'text-center'
                ],
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);  
    }
}
