<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/Service.php');

class ServiceTest extends PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Service') );
    }
    
}

?>
