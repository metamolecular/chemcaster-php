<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Link.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Query.php');
include_once('stubs.php');


class QueryTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $query;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "query": {
                    "molfile": "molfile"
                  }
                }'));


        $this->link = $this->getMock('Registry_Test_Link');

        $this->query = new Chemcaster_Query( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Query') );
    }

    public function testQueryObject()
    {
        $this->assertSame('Chemcaster_Query', get_class($this->query));
    }

    public function testGetMolfile()
    {
        $this->assertSame('molfile', $this->query->molfile);
    }

}

class Query_Test_Link extends Chemcaster_Link
{
    public function __construct(){}
}

?>
