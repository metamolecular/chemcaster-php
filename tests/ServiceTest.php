<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once('stubs.php');

class ServiceTest extends PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Service') );
    }

    public function testServiceObject()
    {
        $trans = $this->getMock('Chemcaster_Transporter');
        $trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{}'));

        $link = new Test_Link();

        $service = new Chemcaster_Service( $trans, $link );
        $this->assertSame('Chemcaster_Service', get_class($service));
    }

    public function testGetVersion()
    {
        $trans = $this->getMock('Chemcaster_Transporter');
        $trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "service": {
                    "version": "0.1.0"
                  }
                }'));

        $link = new Test_Link();

        $service = new Chemcaster_Service( $trans, $link );
        $this->assertSame('0.1.0', $service->version);
    }
}



?>
