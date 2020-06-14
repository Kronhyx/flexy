<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\{FileType, IntegerType, TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;

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
            ->add('price', IntegerType::class)
            ->add('description', TextareaType::class, [
                'required' => false,
                'attr'     => ['rows' => 5],
            ])
            ->add('stock', IntegerType::class)
            ->add('file', FileType::class, [
                'label'       => 'Image',
                'attr'        => ['accept' => 'image/x-png, image/gif, image/jpeg'],
                'required'    => is_null($entity->getId()), //check if product is new to make file upload required
                'mapped'      => false, // unmapped means that this field is not associated to any entity property
                'constraints' => [
                    // unmapped fields can't define their validation using annotations in the associated entity, so we need to use the PHP constraint classes
                    new Constraints\File([
                        'maxSize'          => '5M',
                        'mimeTypesMessage' => 'Please upload a valid image format',
                        'mimeTypes'        => [
                            'image/gif',
                            'image/jpeg',
                            'image/x-png'
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
