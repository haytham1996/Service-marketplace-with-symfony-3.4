<?php

namespace ProfilingBundle\Controller;

use ProfilingBundle\Entity\Tag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TagController extends Controller
{
    /**
     * @Route("/tags.json",name="Profiling.read")
     * @param Request $request
     */
    public function readAction(Request $request){
        $tagRepository=$this->getDoctrine()->getRepository(Tag::class);
        if($q=$request->get('k')){
            $tags=$tagRepository->search($q);
        }else{
            $tags = $tagRepository->findAll();}

        return $this->json($tags,200,[],['groups' => ['public']]);

    }

}
