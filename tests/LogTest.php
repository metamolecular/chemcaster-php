<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Log.php');
include_once('stubs.php');


class LogTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $log;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
             ->method('get')
             ->will($this->returnValue('{
                  "log": {
                    "created_at": "created_at",
                    "interval": "interval"
                  }
                }'));


        $this->link = $this->getMock('Test_Link');

        $this->log = new Chemcaster_Log( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Log') );
    }

    public function testExecutionObject()
    {
        $this->assertSame('Chemcaster_Log', get_class($this->log));
    }

    public function testGetCreatedAt()
    {
        $this->assertSame('created_at', $this->log->created_at);
    }

    public function testGetInterval()
    {
        $this->assertSame('interval', $this->log->interval);
    }
}

?>
