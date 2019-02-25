<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Commentaire;
use ForumBundle\Entity\Topic;
use ForumBundle\Form\TopicType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    public function createAction(Request $request)
    {
        $Topic = new Topic();
        $Topic->setUser($this->getUser());
        $form = $this->createForm(TopicType::class, $Topic);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Topic->setDatePubliee(new \DateTime('now '));
            $Topic = $form->getData();
            $em->persist($Topic);
            $em->flush();

            return $this->redirectToRoute("readTopic");
        }

        return $this->render('@Forum/newTopic.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function readTopicAction()
    {
        $em= $this->getDoctrine()->getManager();
        $Topic = $em->getRepository(Topic::class)->findRecent1();
        $em= $this->getDoctrine()->getManager();
        $request= $this->get('request_stack')->getCurrentRequest();

        if($request->getMethod()=='POST')
        {
            return $this->render("@Forum/readTopic.html.twig",array('topic'=>$Topic));
        }

        return $this->render('@Forum/readTopic.html.twig', array(
            "topic"=>$Topic,
        ));
    }
    public function showTopic($id){
        $em=$this->getDoctrine()->getManager();
        $Topic=$em->getRepository(Topic::class)->find($id);
        $commentaires=$Topic->getCommentaires();
        return $this->render('@Forum/showTopic.html.twig', array(
            'topic' => $Topic,'commentaires'=>$commentaires));
    }

    public function readcommentAction(Request $request,$id,$iduser)
    {
        $em= $this->getDoctrine()->getManager();
        $commentaire=$em->getRepository(Commentaire::class)->findByIdPost($id);
        $topic=$em->getRepository(Topic::class)->findtopic($id);
        $id_sujet=$em->getRepository(Topic::class)->find($id);


        $commentairee = new Commentaire();
        $commentairee->setTopic($id_sujet);
        $user=$this->getUser();
        $commentairee->setUser($user);


        $form=$this->createFormBuilder($commentairee)

            ->add('content',TextType::class)
            ->add('dateCommentaire', DateTimeType::class)
            ->add('save',SubmitType::class)
            ->getForm();


        $form->handleRequest($request);
        if(($form->isSubmitted())&&($form->isValid()))
        {

            $em=$this->getDoctrine()->getManager();
            $commentairee->setDateCommentaire(new \DateTime('now '));
            $em->persist($commentairee);
            $em->flush();

            return $this->redirectToRoute("forum_commentaire",array('id'=>$id,'iduser'=>$iduser));
        }
        return $this->render('@Forum/read_commentaire.html.twig', array(
            "topic"=>$topic,"commentaire"=>$commentaire,'user'=>$user,"form"=>$form->createView()
        ));
    }



}
