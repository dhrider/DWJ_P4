<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',          TextType::class, array(
                'attr' => array(
                    'required'
                ),
                'label' => 'Titre :'
            ))
            ->add('content',        TextareaType::class, array(
                'attr' => array(
                    'class' => 'mce-tinymce',
                    'required'
                ),
                'label' => 'Texte :'
            ))
            ->add('Submit',         SubmitType::class, array(
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
            'data_class' => 'BlogBundle\Entity\Billet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_billet';
    }


}
