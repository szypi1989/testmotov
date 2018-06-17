<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Cars;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT a FROM AppBundle:Cars a");  
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        5/*limit per page*/,array('defaultSortFieldName' => 'a.model', 'defaultSortDirection' => 'asc')
        );    
        return array('pagination' => $pagination);
    }
}
