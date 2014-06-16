<?php

namespace Joli\Bundle\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;


/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    protected $paginator;

    public function getPublishedPosts() {
        $qb = $this->getBaseQuery();
        /*
        $qb->where('p.is_published = :is_published')
                ->setParameter('is_published', true);
        */
        $query = $qb->getQuery();
        
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
     
        
     //   return $pagination;
        return $query->execute();
    
    }
    
    
    public function getPagination($page = 1) {
        $qb = $this->getBaseQuery();
        $query = $qb->getQuery();
        
        
        $paginator  = $this->paginator;
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            10/*limit per page*/
        );
     
        return $pagination;
     //   return $query->execute();
    
    }
    
    public function setPaginator($paginator) {
        $this->paginator = $paginator;
    }
    
    public function searchFor($word, $is_published = null) {
        $qb = $this->getBaseQuery()
                ->where('p.body LIKE :search');
        
        if (null !== $is_published){
            $qb->andWhere('p.is_published = :is_published');
            $qb->setParameter('is_published', $is_published);
        }
        
        $qb->setParameter('search', '%'.$word.'%');
        
        $query = $qb->getQuery();
        
        return $query->execute();
        
    }


    protected function getBaseQuery() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb->select('p')
                ->from('JoliBlogBundle:Post', 'p');
    }
    
}