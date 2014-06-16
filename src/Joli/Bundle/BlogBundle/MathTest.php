<?php

namespace Joli\Bundle\BlogBundle;

class MathTest extends \PHPUnit_TestCase
{
    /**
     * 
     * 
     * 
     */
    public function TestSquare(){
        $math = new Math();
        
        $result = $math->square(5);
        
        $this->assertEquals(25, $result);
        
    }
}