<?php

namespace ProfilingBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

   public function buildForm(FormBuilderInterface $builder, array $options)
   {
       $builder->addModelTransformer(new CollectionToArrayTransformer(),true)
               ->addModelTransformer(new TagTransformer($this->manager),true);
   }

   public function configureOptions(OptionsResolver $resolver)
   {
    $resolver->setDefault('attr',[
       'data-role'=>'tagsinput'
    ]);
    $resolver->setDefault('required',false);
   }

    public function getParent()
   {
    return TextType::class;
   }


}
