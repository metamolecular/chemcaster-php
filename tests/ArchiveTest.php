<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Archive.php');
include_once('stubs.php');


class ArchiveTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $archive;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
          ->method('get')
          ->will($this->returnValue('{
              "archive": {
                "done": "done",
                "created_at": "created_at"
              }
            }'));


        $this->link = $this->getMock('TestLink');

        $this->archive = new Chemcaster_Archive( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Archive') );
    }

    public function testArchiveCreate()
    {
        
        $this->assertTrue('Chemcaster_Archive' == get_class($this->archive));
    }

    public function testArchiveDone()
    {
        $this->assertSame("done", $this->archive->done);
    }

    public function testArchiveCreatedAt()
    {
        $this->assertSame("created_at", $this->archive->created_at);
    }
}

?>
