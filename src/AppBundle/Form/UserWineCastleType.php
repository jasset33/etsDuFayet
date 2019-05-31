<?php

namespace AppBundle\Form;

//use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WineCastleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameCastle')
            ->add('display')
            ->add('contactCommercial', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('castlePicture',FileType::class,
                [
                    'required' => false
                ])
            ->add('wineDescription', TextareaType::class,
                [
                    'required' => false
                ]
            )
            ->add('address1Castle', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('address2Castle', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('cpCastle', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('townCastle', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('phoneCastle', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('mailCastle', EmailType::class,
                [
                    'required' => false
                ]
            )
            ->add('aocCastle', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('area', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('ground', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('density', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('ageVine', IntegerType::class,
                [
                    'required' => false
                ]
            )
            ->add('production', TextType::class,
                [
                    'required' => false
                ]
            )
            ->add('vintage', TextareaType::class,
                [
                    'required' => false
                ]
            )
            ->add('raising', TextareaType::class,
                [
                    'required' => false
                ]
            )
            ->add('submit', SubmitType::Class, array('label' => 'Valider'));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\WineCastle'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_winecastle';
    }


}
