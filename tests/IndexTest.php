<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Index.php');
include_once('stubs.php');


class IndexTest extends PHPUnit_Framework_TestCase
{

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Index') );
    }

    public function testGetRegistriesIndex()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $registries = $service->registries;
        $this->assertTrue( 'Chemcaster_Index' === get_class($registries) );
    }
}

?>
