<?php

namespace Joli\Bundle\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\FixtureInterface;

use Joli\Bundle\BlogBundle\Entity\Post;

class LoadPostFixtures implements FixtureInterface
{

    public function load( ObjectManager $manager ) {
        $i = 1;
        
        while ($i < 100) {

            $post = new Post;

            $post->setTitle('Title test'.$i);
            $post->setBody('test body '.$i);
            $post->setIsPublished($i%2);

//            $post->setCategory( );
            
            $manager->persist($post);
            $i++;
        }
        
        $manager->flush();

        
    }
    
}