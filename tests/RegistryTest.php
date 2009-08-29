<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Registry.php');
include_once('stubs.php');


class RegistryTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $registry;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "registry": {
                    "name": "bar"
                  }
                }'));


        $this->link = $this->getMock('Registry_Test_Link');

        $this->registry = new Chemcaster_Registry( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Registry') );
    }

    public function testRegistryObject()
    {
       $this->assertSame('Chemcaster_Registry', get_class($this->registry));
    }

    public function testGetName()
    {
        $this->assertSame('bar', $this->registry->name);
    }
    
}

class Registry_Test_Link extends Chemcaster_Link
{
    public function __construct(){}
}

?>
