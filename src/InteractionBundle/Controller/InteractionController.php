<?php

namespace InteractionBundle\Controller;

use InteractionBundle\Entity\Avis;
use InteractionBundle\Form\AvisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use UserBundle\Entity\User;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class InteractionController extends Controller
{
    public function AvisAction(Request $request,$id)
    {

        $u = $this->container->get('security.token_storage')->getToken()->getUser();
        $avis = new Avis();
        $avis->setUser($this->getUser());
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $avis->setDatePublication(new \DateTime('now '));
            $avis->setUser($u);

            $em = $this->getDoctrine()->getManager();
            $avis = $form->getData();
            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute("showAvis",array('user'=>$id));

        }
        return $this->render('@Interaction/addAvis.html.twig', array(
            "form" => $form->createView()
        ));

    }

    public function showAvisAction(Request $request)
    {
        {

            $u = $this->container->get('security.token_storage')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();
            $posts=$em->getRepository(Avis::class)->findAll();

            return $this->render('@Interaction/showAvis.html.twig', array(
                "posts" => $posts
            ));
        }
    }
}