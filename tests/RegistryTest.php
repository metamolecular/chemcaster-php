<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Index.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Registry.php');
include_once('stubs.php');


class RegistryTest extends PHPUnit_Framework_TestCase
{

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Registry') );
    }

    public function testGetRegistriesIndexes()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $registries = $service->registries;
        
        $this->assertSame(2, $registries->size());

        foreach( $registries as $registry )
        {
            $this->assertSame( 'Chemcaster_Registry', get_class($registry));
        }

        $registry = $registries[0];
        $this->assertSame( 'Chemcaster_Registry', get_class($registry));

        $this->assertSame('foo', $registry->name);
    }
    
    public function testCreateRegistry()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $registries = $service->registries;
        
        $ret = $registries->create( array('name' => 'hello' ) );
        
        $this->assertTrue('Chemcaster_Registry' === get_class($ret) );
    }
}

?>
