<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Index.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Registry.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Structure.php');
include_once('stubs.php');


class StructureTest extends PHPUnit_Framework_TestCase
{

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Structure') );
    }

    public function testGetStructures()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $registries = $service->registries;

        $resgistry = $registries[0];
        $structures = $resgistry->structures;
        $this->assertSame( 'Chemcaster_Index', get_class($structures) );

        $structure = $structures[0];
        $this->assertSame('Chemcaster_Structure', get_class($structure) );
    }

    public function testGetAttributes()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $registries = $service->registries;

        $resgistry = $registries[0];
        $structures = $resgistry->structures;
        $this->assertSame( 'Chemcaster_Index', get_class($structures) );

        $structure = $structures[0];

        $this->assertSame( 'woozle', $structure->name );
        $this->assertSame( 'molfile...', $structure->molfile );
        $this->assertSame( 'inchi...', $structure->inchi );
    }
}

?>
