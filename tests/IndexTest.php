<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Index.php');
include_once('stubs.php');


class IndexTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $index;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "items": [
                    {
                      "media_type": "application\/vnd.com.chemcaster.Index+json",
                      "name": "test",
                      "uri": "test"
                    }
                  ]
                }'));

        $this->link = $this->getMock('Test_Link');

        $this->index = new Chemcaster_Index( $this->trans, $this->link );
    }
    
    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Index') );
    }

    public function testIndexObject()
    {
        $this->assertSame('Chemcaster_Index', get_class($this->index));
    }

    public function testIndexAccessArray()
    {
        $test_array = array();
        
        foreach( $this->index as $v )
        {
            $test_array[] = $v;
        }

        $this->assertSame(1, count($test_array) );
    }

}

?>
