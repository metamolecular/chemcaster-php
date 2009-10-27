<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Structure.php');
include_once('stubs.php');


class StructureTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $structure;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
          ->method('get')
          ->will($this->returnValue('{
              "structure": {
                "serialization": "serialization",
                "inchi": "inchi"
              }
            }'));


        $this->link = $this->getMock('Structure_Test_Link');

        $this->structure = new Chemcaster_Structure( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Structure') );
    }

    public function testStructureCreate()
    {
        
        $this->assertTrue('Chemcaster_Structure' == get_class($this->structure));
    }

    public function testStructureSerialization()
    {
        $this->assertSame('serialization', $this->structure->serialization);
    }

    public function testStructureInchi()
    {
        $this->assertSame('inchi', $this->structure->inchi);
    }
}

class Structure_Test_Link extends Chemcaster_Link
{
    public function __construct(){}
}

?>
