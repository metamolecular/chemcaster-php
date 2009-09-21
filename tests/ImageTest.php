<?php

require_once('PHPUnit/Framework.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Representation.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Item.php');
include_once(dirname(__FILE__) . '/../lib/chemcaster/Image.php');
include_once('stubs.php');


class ImageTest extends PHPUnit_Framework_TestCase
{
    protected $trans;
    protected $link;
    protected $image;

    public function setUp()
    {
        $this->trans = $this->getMock('Chemcaster_Transporter');
        $this->trans->expects($this->any())
          ->method('get')
          ->will($this->returnValue('{
              "image": {
                "width": "width",
                "height": "height",
                "format": "format",
                "data": "data"
              }
            }'));


        $this->link = $this->getMock('Test_Link');

        $this->image = new Chemcaster_Image( $this->trans, $this->link );
    }

    public function testClassExists()
    {
        $this->assertTrue( class_exists('Chemcaster_Image') );
    }

    public function testImageObject()
    {

        $this->assertTrue('Chemcaster_Image' == get_class($this->image));
    }

    public function testImageWidth()
    {
        $this->assertSame('width', $this->image->width);
    }

    public function testImageHeight()
    {
        $this->assertSame('height', $this->image->height);
    }

    public function testImageFormat()
    {
        $this->assertSame('format', $this->image->format);
    }

    public function testImageData()
    {
        $this->assertSame('data', $this->image->data);
    }
}


?>
