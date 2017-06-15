<?php

namespace Vaniusa\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VaniusaBlogBundle:Post')->findAll();
        return $this->render('VaniusaBlogBundle:Default:index.html.twig', array('post'=>$post));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ppost = $em->getRepository('VaniusaBlogBundle:Post')->find($id);
        return $this->render('VaniusaBlogBundle:Default:show.html.twig', array('ppost'=>$ppost));
    }

    public function langAction(Request $request)
    {
        return $this->redirectToRoute('vaniusa_blog_homepage');
    }

    public function pagAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VaniusaBlogBundle:Post')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($post, $request->query->getInt('page', 1), 2);
        return $this->render('VaniusaBlogBundle:Default:pag.html.twig', array('pagination'=>$pagination));
    }
}
