<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\{FileType, NumberType, TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

/**
 * Class ProductType
 * @package App\Form
 */
class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /**@var Product $entity */
        $entity = $builder->getData();

        $builder
            ->add('title', TextType::class)
            ->add('price', NumberType::class)
            ->add('description', TextareaType::class)
            ->add('stock', NumberType::class)
            ->add('file', FileType::class, [
                'label'       => 'Image',
                'required'    => is_null($entity->getId()), //check if product is new to make file upload required
                'mapped'      => false,
                'constraints' => [
                    new File([
                        'maxSize'          => '5M',
                        'mimeTypesMessage' => 'Please upload a valid image format',
                        'mimeTypes'        => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                    ]),
                ],
            ])
            ->add('tags', EntityType::class, [
                'class'    => Tag::class,
                'required' => false,
                'multiple' => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
