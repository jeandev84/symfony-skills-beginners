<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;



/**
 * Class PostType
 * @package App\Form
 */
class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => 'App\Entity\Category',
                'placeholder' => 'Select a category',
                'mapped' => false
            ]);

            $builder->get('category')->addEventListener(
                FormEvents::POST_SUBMIT,
                 function (FormEvent $event) {
                      $form = $event->getForm();
                      /* dump($form); $form->getData() return Category */

                      /* $data = $event->getData(); */
                      $form->getParent()->add('sub_category', EntityType::class, [
                          'class' => 'App\Entity\SubCategory',
                          'placeholder' => 'Please select a sub category',
                          'choices' => $form->getData()->getSubCategories()
                      ]);
                 }
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
