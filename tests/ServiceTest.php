<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once('stubs.php');

class ServiceTest extends PHPUnit_Framework_TestCase
{

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Service') );
    }

    public function testConnect()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $this->assertSame('Chemcaster_Service', get_class($service));
    }

    public function testGetVersion()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $this->assertSame('0.1.0', $service->version);
    }
}

?>
