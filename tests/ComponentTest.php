<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Component.php');
include_once('stubs.php');


class ComponentTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $component;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
          ->method('get')
          ->will($this->returnValue('{
              "component": {
                "multiplier": 2
              }
            }'));


        $this->link = $this->getMock('TestLink');

        $this->component = new Chemcaster_Component( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Component') );
    }

    public function testComponentCreate()
    {
        
        $this->assertTrue('Chemcaster_Component' == get_class($this->component));
    }

    public function testComponentMultiplier()
    {
        $this->assertSame(2, $this->component->multiplier);
    }
}

?>
