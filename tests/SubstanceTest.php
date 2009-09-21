<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Substance.php');
include_once('stubs.php');


class SubstanceTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $substance;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
          ->method('get')
          ->will($this->returnValue('{
              "substance": {
                "serialization": "serial",
                "inchi": "inchi"
              }
            }'));


        $this->link = $this->getMock('Test_Link');

        $this->substance = new Chemcaster_Substance( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Substance') );
    }

    public function testSubstanceCreate()
    {
        
        $this->assertTrue('Chemcaster_Substance' == get_class($this->substance));
    }

    public function testSubstanceSerialization()
    {
        $this->assertSame('serial', $this->substance->serialization);
    }

    public function testSubstanceInchi()
    {
        $this->assertSame('inchi', $this->substance->inchi);
    }
}

?>
