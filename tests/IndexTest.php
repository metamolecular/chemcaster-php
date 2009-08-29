<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Index.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Structure.php');
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
                      "media_type": "application\/vnd.com.chemcaster.Structure+json",
                      "name": "uhh",
                      "uri": "http:\/\/chemcaster.com\/structures\/197"
                    }
                  ]
                }'));

        $this->link = $this->getMock('Index_Test_Link');

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

    public function testIndexGetStructureItem()
    {
        $struct = $this->getMock(
            'Chemcaster_Structure',
            array('__getFunctions'),
            array($this->trans, $this->link),
            'Structure_Index_Test_Mock',
            false
        );

        $this->assertSame( 'Chemcaster_Structure', get_class($this->index[0]));
    }

}

class Index_Test_Link extends Chemcaster_Link
{
    public function __construct(){}
}

?>
