<?php

namespace EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user=null;
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        if(in_array('ROLE_SUPER_ADMIN',$user->getRoles()))
        {
            return $this->redirectToRoute('admin_homepage');
        }
        return $this->render('@Event/Default/404.html.twig',array('user'=>$user));
    }

    public function indexAdminAction()
    {
        $user=null;
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        if(in_array('ROLE_SUPER_ADMIN',$user->getRoles()))
        {
           // return $this->render('@Event/admin/index.html.twig',array('user'=>$user));
            return $this->redirectToRoute('evenement_index');
        }
        return $this->redirectToRoute('event_404');
    }

    public function wrongAction()
    {
        $user=null;
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }

        return $this->render('@Event/Default/404.html.twig',array('user'=>$user));
    }
}
