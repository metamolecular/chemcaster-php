<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once('stubs.php');

class ServiceTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $service;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "service": {
                    "version": "0.1.0"
                  }
                }'));


        $this->link = $this->getMock('Service_Test_Link');

        $this->service = new Chemcaster_Service( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Service') );
    }

    public function testServiceObject()
    {
        $this->assertSame('Chemcaster_Service', get_class($this->service));
    }

    public function testGetVersion()
    {
        $this->assertSame('0.1.0', $this->service->version);
    }
}

class Service_Test_Link extends Chemcaster_Link
{
    public function __construct(){}
}

?>
