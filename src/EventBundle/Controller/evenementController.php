<?php

namespace EventBundle\Controller;

use DateTime;
use EventBundle\Entity\category;
use EventBundle\Entity\evenement;
use EventBundle\Entity\Likes;
use EventBundle\Entity\participation;
use EventBundle\EventBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Evenement controller.
 *
 */
class evenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = null;
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $Likes = $em->getRepository(Likes::class)->findBy(array('user' => $user->getId()));
        $my_array = array();
        foreach ($Likes as $like) {
            array_push($my_array, $like->getEvenement()->getId());
        }
        $evenements = $em->getRepository('EventBundle:evenement')->findAll();
        return $this->render('@Event/Admin/index.html.twig', array('evenements' => $evenements, 'user' => $user, 'liked' => $my_array));
    }

    public function indexEventAction(Request $request)
    {
        $user = null;
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $date = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT e FROM EventBundle:evenement e";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query,/*query NOT result*/
            $request->query->getInt('page', 1)/* page number*/, 4);
        $evenements = $em->getRepository('EventBundle:evenement')->findAll();
        $categories = $em->getRepository('EventBundle:category')->findAll();
        $Likes = $em->getRepository(Likes::class)->findBy(array('user' => $user->getId()));
        $my_array = array();
        foreach ($Likes as $like) {
            array_push($my_array, $like->getEvenement()->getId());
        }
        return $this->render('@Event/Default/index.html.twig', array('pagination' => $pagination, 'categories' => $categories, 'liked' => $my_array, 'date2' => $date,));
    }

    public function showInfoAction(evenement $evenement)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($evenement);
        $evenementt=$em->getRepository(evenement::class)->find($evenement->getId());
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        //$ide=$evenement->getId()
        $participation = $em->getRepository(participation::class)->findPart($evenementt);
        $participTest = $this->getDoctrine()->getRepository("EventBundle:participation")->findPa($evenement, $user);
        $categories = $em->getRepository('EventBundle:category')->findAll();
        return $this->render('@Event/Default/showInfo.html.twig', array('evenement' => $evenement, 'delete_form' => $deleteForm->createView(), 'categories' => $categories, 'participTest' => $participTest,'participation'=>$participation,

        ));
    }
  public function annulerParticipationAction($id ,evenement $evenement){
        $em=$this->getDoctrine()->getManager();
        $evenementt=$em->getRepository(evenement::class)->find($evenement->getId());
        $participation=$em->getRepository(participation::class)->find($id);
        $em->remove($participation);
        $em->flush();
        return $this->redirectToRoute('showInfo',array('evenement'=>$evenement,));
    }

    /**
     * Creates a new evenement entity.
     *
     */
    public function newAction(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createForm('EventBundle\Form\evenementType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $evenement->setNbrJaime(0);
            $evenement->setNbnscription(0);
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_show', array('id' => $evenement->getId()));
        }

        return $this->render('@Event/Admin/new.html.twig', array('evenement' => $evenement, 'form' => $form->createView(),));
    }

    /**
     * Finds and displays a evenement entity.
     *
     */
    public function showAction(evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('@Event/Admin/show.html.twig', array('evenement' => $evenement, 'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     */
    public function editAction(Request $request, evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('EventBundle\Form\evenementType', $evenement);
        $editForm->add('Modifier', SubmitType::class);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('evenement_edit', array('id' => $evenement->getId()));
            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('@Event/Admin/edit.html.twig', array('evenement' => $evenement, 'form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Deletes a evenement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository(evenement::class)->find($id);
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute("evenement_index");
    }

    /**
     * Creates a form to delete a evenement entity.
     *
     * @param evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(evenement $evenement)
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('evenement_delete', array('id' => $evenement->getId())))->setMethod('DELETE')->getForm();
    }

    public function eventByCategoryAction(category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('EventBundle:category')->findAll();
        $evenements = $this->getDoctrine()->getManager()->getRepository(evenement::class)->findBy(array('category' => $category));

        return $this->render('@Event/Default/listEventCategory.html.twig', array('evenements' => $evenements, 'categories' => $categories));
    }

    public function eventFiltreAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = null;
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $Likes = $em->getRepository(Likes::class)->findBy(array('user' => $user->getId()));
        $my_array = array();
        foreach ($Likes as $like) {
            array_push($my_array, $like->getEvenement()->getId());
        }
        if (isset($_POST['categ'])) {
            $_SESSION['haytham'] = $_POST['categ'];
        }
        $in = '(' . implode(',', $_SESSION['haytham']) . ')';
        $em = $this->get('doctrine.orm.entity_manager');
        $dql = 'SELECT e FROM EventBundle:evenement e WHERE e.category IN ' . $in;
        $query = $em->createQuery($dql);
        $user = $this->getUser();
        $category = $em->getRepository('EventBundle:category')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/, 2/*limit per age*/);

        // parameters to template
        return $this->render('@Event/Default/index.html.twig', array('pagination' => $pagination, 'user' => $user, 'categories' => $category, 'liked' => $my_array));
    }

    public function LikeAction($id)
    {

        $user = null;
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $likes = $this->getDoctrine()->getRepository(Likes::class)->findOneBy(array('user' => $user->getId(), 'evenement' => $id,));
        if ($likes == null) {
            $evenement = new evenement();
            $evenement = $this->getDoctrine()->getRepository(evenement::class)->find($id);
            $evenement->setNbrjaime($evenement->getNbrjaime() + 1);
            $like = new Likes();
            $like->setUser($user);
            $like->setevenement($evenement);
            $this->getDoctrine()->getManager()->persist($like);
            $this->getDoctrine()->getManager()->flush();
            $data = array('type' => '1', 'nbr' => $evenement->getNbrjaime());
        } else {
            $evenement = new evenement();
            $evenement = $this->getDoctrine()->getRepository(evenement::class)->find($id);
            $evenement->setNbrjaime($evenement->getNbrjaime() - 1);
            $this->getDoctrine()->getManager()->remove($likes);
            $this->getDoctrine()->getManager()->flush();
            $data = array('type' => '0', 'nbr' => $evenement->getNbrjaime());
        }
        $response = new JsonResponse();
        $response->setData(array('data' => $data), 200);
        return $response;

    }

    public function ParticipationAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $participation = new participation();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $evenement = $em->getRepository("EventBundle:evenement")->find($id);
        $participTest = $this->getDoctrine()->getRepository("EventBundle:participation")->findP($evenement, $user);
        $categories = $em->getRepository('EventBundle:category')->findAll();
        if ($participTest == null) {
            $evenement->setNbnscription($evenement->getNbnscription() + "1");
            $participation->setEvenement($evenement);
            $participation->setUser($user);
            $em->persist($participation);
            $em->flush();
            //return new JsonResponse("ok");


        }
        return $this->render('@Event/Default/showInfo.html.twig', array('evenement' => $evenement, 'categories' => $categories, 'participTest' => $participTest));


    }


    }
