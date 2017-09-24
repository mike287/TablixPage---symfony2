<?php

namespace Project\TablixBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class PostsController extends Controller
{
    protected $paginateNumber = 3;
    
    /**
     * @Route(
     *      "/{page}",
     *      name= "page_index",
     *      defaults = {"page" = 1 },
     *      requirements = {"page" = "\d+"} 
     * )
     * 
     * @Template("ProjectTablixBundle:Posts:postsList.html.twig")
     */
    
    public function indexAction($page)
    {
        
        $PostRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Post');
//        $findAll = $em->findBy(array(), array('publishedDate'=>'desc'));
        
        $qb = $PostRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
            
            
            
        ));
        
        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->paginateNumber);
         
        
        return array ('pagination'=>$pagination,
                        'listTitle'=> 'Najnowsze wpisy'    );
    }
    
        /**
     * @Route("/search/{page}",
     *      name= "page_search",
     *      defaults = {"page" = 1 },
     *      requirements = {"page" = "\d+"}
     * )
     * 
     * @Template("ProjectTablixBundle:Posts:postsList.html.twig")
     */
    public function searchAction(\Symfony\Component\HttpFoundation\Request $request, $page)
    {
        $searchParam = $request->query->get('search');
        
        $PostRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Post');
//        $findAll = $em->findBy(array(), array('publishedDate'=>'desc'));
        
        $qb = $PostRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'search' => $searchParam
            
            
            
        ));
        
        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->paginateNumber);
         
        
        return array ('pagination'=>$pagination,
                        'listTitle'=> sprintf('Wyniki wyszukiwania "%s"', $searchParam),
                           'searchParam' => $searchParam );

    }
    
    /**
     * @Route(
     *      "/{slug}",
     *      name = "page_post"
     * )
     * 
     * @Template()
     */
    public function postAction($slug)
    {
        $PostRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Post');
        
                $Post = $PostRepo->getPublishedPost($slug);
                
                if($Post === null)
                {
                    throw $this->createNotFoundException('Post nie został znaleziony');
                }
        
        return array (
            'post'=>$Post
                );
    }
    
    /**
     * @Route(
     *      "/category/{slug}/{page}",
     *      name = "page_category",
     *      defaults = {"page" = 1 },
     *      requirements = {"page" = "\d+"}
     * )
     * 
     * @Template("ProjectTablixBundle:Posts:postsList.html.twig")
     */
    public function categoryAction($slug, $page)
    {
        $PostRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Post');
        $qb = $PostRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'categorySlug' => $slug
                 
        ));
        
        $CategoryRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Category');
        $Category = $CategoryRepo->findOneBySlug($slug);
        
        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->paginateNumber);
         
        
        return array ('pagination'=>$pagination,
                        'listTitle' => sprintf('wpisy w kategorii "%s"', $Category->getName())
            );
    

    }
    
    /**
     * @Route(
     *      "/tag/{slug}/{page}",
     *      name = "page_tag",
     *      defaults = {"page" = 1 },
     *      requirements = {"page" = "\d+"}
     * )
     * 
     * @Template("ProjectTablixBundle:Posts:postsList.html.twig")
     */
    public function tagAction($slug, $page)
    {
        $PostRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Post');
        $qb = $PostRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'tagSlug' => $slug
                 
        ));
        
        $TagRepo = $this->getDoctrine()->getRepository('ProjectTablixBundle:Tag');
        $Tag = $TagRepo->findOneBySlug($slug);
        
        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->paginateNumber);
         
        
        return array ('pagination'=>$pagination,
                        'listTitle' => sprintf('wpisy z tagiem "%s"', $Tag->getName())
            );
            }
        

}
