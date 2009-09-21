<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Execution.php');
include_once('stubs.php');


class ExecutionTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $execution;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "execution": {
                    "cursor": "cursor",
                    "reverse": "reverse",
                    "maximum_results": "maximum_results",
                    "next_cursor": "next_cursor",
                    "previous_cursor": "previous_cursor"
                  }
                }'));


        $this->link = $this->getMock('Test_Link');

        $this->execution = new Chemcaster_Execution( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Execution') );
    }

    public function testExecutionObject()
    {
        $this->assertSame('Chemcaster_Execution', get_class($this->execution));
    }

    public function testGetCursor()
    {
        $this->assertSame('cursor', $this->execution->cursor);
    }

    public function testGetReverse()
    {
        $this->assertSame('reverse', $this->execution->reverse);
    }
    
    public function testGetMaxResults()
    {
        $this->assertSame('maximum_results', $this->execution->maximum_results);
    }

    public function testGetNextCursor()
    {
        $this->assertSame('next_cursor', $this->execution->next_cursor);
    }

    public function testGetPreviousCursor()
    {
        $this->assertSame('previous_cursor', $this->execution->previous_cursor);
    }

}

?>
