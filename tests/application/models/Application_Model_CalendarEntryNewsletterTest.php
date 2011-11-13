<?php

require_once dirname(__FILE__) . '/../../../application/models/AppDateTime.php';
require_once dirname(__FILE__) . '/../../../application/models/ReoccurenceTemplate.php';
require_once dirname(__FILE__) . '/../../../application/models/CalendarGroupInterface.php';
require_once dirname(__FILE__) . '/../../../application/models/CalendarGroupAbstract.php';
require_once dirname(__FILE__) . '/../../../application/models/CalendarEntryNewsletter.php';

/**
 * Test class for Application_Model_CalendarEntryNewsletter.
 * Generated by PHPUnit on 2011-11-13 at 02:13:39.
 */
class Application_Model_CalendarEntryNewsletterTest extends PHPUnit_Framework_TestCase {

   /**
    * @var Application_Model_CalendarEntryNewsletter
    */
   protected $object;

   /**
    * Sets up the fixture, for example, opens a network connection.
    * This method is called before a test is executed.
    */
   protected function setUp() {
      $this->object = new Application_Model_CalendarEntryNewsletter;
   }

   /**
    * Tears down the fixture, for example, closes a network connection.
    * This method is called after a test is executed.
    */
   protected function tearDown() {
      
   }
   
   public function testGetEntries() {
      $this->object = new Application_Model_CalendarEntryNewsletter;
      $this->assertArrayHasKey(0, $this->object->getEntries(2010, 02));
      
   }

}

?>
