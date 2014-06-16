<?php

namespace Joli\Bundle\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\AbstractFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;

use Joli\Bundle\BlogBundle\Entity\Category as CategoryEntity;

class Category extends AbstractFixture implements FixtureInterface
{

    public function load( ObjectManager $manager ) {
        $i = 1;
        
        while ($i < 100) {

            $category = new CategoryEntity;

            $category->setName('category n '.$i);

            
            
            $manager->persist($category);
            $i++;
        }
        
        $manager->flush();

        
    }
    
}