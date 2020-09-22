<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Form\ImageType;
use App\Form\VideoType;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Titre du trick',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description du trick',
                ],
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'label' => 'Image',
                'data_class' => null,
                'constraints' => [
                    new Image([
                        'maxSize' => '5M',
                    ])
                ]
            ])
            ->add('images', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])

            ->add('video', TextType::class,[
                'label' => false,
                'mapped' => false,
                'required' => false
            ])
            
            ->add('categoryId', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => 'Catégorie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
