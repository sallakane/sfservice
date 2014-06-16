<?php
namespace Joli\Bundle\BlogBundle\Search;

class Simple
{
    /**
     * 
     * 
     * 
     */

    protected $em;
    
    public function __construct($em) {
        $this->em = $em;
    }


    public function search($word, $is_published = null){
        return $this->em
                ->getRepository('JoliBlogBundle:Post')
                ->searchFor($word, $is_published);
    }
}