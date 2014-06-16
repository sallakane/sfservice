<?php

namespace Joli\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Joli\Bundle\BlogBundle\Entity\Post;
use Joli\Bundle\BlogBundle\Form\SearchFormType;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}/{city}")
     */
    public function helloAction($city, $name)
    {
        return new Response(sprintf('Bonjour %s, on est à %s.', $name, $city) );
    }
    
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        
        $repository = $this->get('post.repository');
        
        $pagination = $repository->getPagination( $request->get('page') );
        
        return array('pagination' => $pagination );

        
    }
    
    
    /**
     * @Route("/propose", name="blog_propose")
     * @Template()
     */
    public function proposeAction( )
    {
        $post = new Post;
        $form = $this->createFormBuilder($post)
        ->add('title')
        ->add('body')
//        $form->add('category');
        ->getForm();
        
        
        
        return array('form' => $form->createView(), );

        
    }
    
    
    /**
     * @Route("/search", name="blog_search")
     * @Template()
     */
    public function searchAction(Request $request )
    {
        $form = $this->createForm(new SearchFormType());
        $form->bind($request);
        
        return array('form' => $form->createView(), );
    }
    
    /**
     * @Route("/search/result", name="blog_search_result")
     * @Template()
     */
    public function searchResultAction(Request $request )
    {
        $form = $this->createForm(new SearchFormType());
        $form->bind($request);
        $results = array();
        
        if ( $form->isValid() ){
            $data = $form->getData();
            $results = $this->get('formation.blog.search')->search(
                    $data['search'],
                    $data['is_published']
            );
            
        } else {
            //Redirect
        }
        
        return array('form' => $form->createView(), 'results' => $results );
    }

    
    
    /**
     * @Route("/current-time")
     * @Template()
     */
    public function currentTimeAction()
    {
        return array('time' => date('d/m/Y H:i') );
    }
    
    
    /**
     * @Route("/create-entity")
     */
    public function entityAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        $post = new Post;
        
        $post->setTitle('Title test');
        $post->setBody('test body');

        $em->persist($post);
        $em->flush();
        
        return new Response(sprintf('TEST INSERT ok') );
    }
    
    /**
     * @Template()
     */
    public function squareAction($number)
    {
        $square = $this->get('formation.math')->square($number);
        return new Response(sprintf('square %s.', $square) );
    }
    
    
    
}
