<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Registration.php');
include_once('stubs.php');


class RegistrationTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $registration;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "registration": {
                    "templates": []
                  }
                }'));

        $link = new Test_Link();

        $this->registration = new Chemcaster_Registration( $this->trans, $link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Registration') );
    }

    public function testRegistryObject()
    {
       $this->assertSame('Chemcaster_Registration', get_class($this->registration));
    }

    public function testGetName()
    {
        $this->assertSame(array(), $this->registration->templates);
    }
    
}
?>
