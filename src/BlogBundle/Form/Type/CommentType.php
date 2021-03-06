<?php
// sr/BlongBundle/Form/Type/CommentType.php

namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    // création d'un formulaire de commentaire
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author',     TextType::class, array(
                'attr' => array(
                    'class' => 'author',
                    'required',
                    'placeholder' => 'Entrez votre nom'
                ),
                'label' => false // on cache le label
            ))
            ->add('content',   TextareaType::class, array(
                'attr' => array(
                    'class' => 'comment',
                    'required',
                    'placeholder' => 'Votre commentaire'
                ),
                'label' => false // on cache le label
            ))
            ->add('submit',     SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn-primary'
                ),
                'label' => 'Valider'
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_comment';
    }


}
