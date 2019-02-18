<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 16/02/2019
 * Time: 06:19
 */

namespace ProfilingBundle\Form;


use Doctrine\Common\Persistence\ObjectManager;
use ProfilingBundle\Entity\Tag;
use Symfony\Component\Form\DataTransformerInterface;

class TagTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
            {
                $this->manager = $manager;
            }

    public function transform($value):string {

             return implode(',',$value);

            }

            public function reverseTransform($string):array
            {
            $names=array_unique(array_filter(array_map('trim',explode(',',$string))));
            $tags=[];
            $tags=$this->manager->getRepository(Tag::class)->findBy([
                'nom'=>$names
            ]);
            $newnames=array_diff($names,$tags);
            foreach ($newnames as $n){
                $tag = new Tag();
                $tag->setNom($n);
                $tags[]=$tag;
            }
                return $tags;
            }
}