<?php

require_once dirname(__FILE__) . '/../../../application/models/AppDateTime.php';

/**
 * Test class for Application_Model_AppDateTime.
 * Generated by PHPUnit on 2011-11-12 at 11:10:58.
 */
class Application_Model_AppDateTimeTest extends PHPUnit_Framework_TestCase {

   /**
    * @var Application_Model_AppDateTime
    */
   protected $object;

   /**
    * Sets up the fixture, for example, opens a network connection.
    * This method is called before a test is executed.
    */
   protected function setUp() {
//      $this->object = new Application_Model_AppDateTime;
   }

   /**
    * Tears down the fixture, for example, closes a network connection.
    * This method is called after a test is executed.
    */
   protected function tearDown() {
      
   }

   public function testIsWeekDay() {
      //Thursday
      $this->object = new Application_Model_AppDateTime('2011-11-10');
      $this->assertTrue($this->object->isWeekDay());
      //Saturday
      $this->object = new Application_Model_AppDateTime('2011-11-12');
      $this->assertFalse($this->object->isWeekDay());
      
   }

}

?>
