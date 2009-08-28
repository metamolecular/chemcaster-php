<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Service.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Index.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Registry.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Structure.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Query.php');
include_once('stubs.php');


class QueryTest extends PHPUnit_Framework_TestCase
{

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Query') );
    }

    public function testGetQueries()
    {
        $service = Chemcaster_Service::connect('username', 'password');
        $registries = $service->registries;

        $resgistry = $registries[0];
        $queries = $resgistry->queries;
        $this->assertSame( 'Chemcaster_Index', get_class($queries) );
    }

}

?>
