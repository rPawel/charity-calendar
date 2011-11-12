<?php

//require_once dirname(__FILE__) . '/../../../application/models/ReoccurenceTemplate.php';
//require_once dirname(__FILE__) . '/../../../application/models/CalendarGroupInterface.php';
//require_once dirname(__FILE__) . '/../../../application/models/CalendarGroupAbstract.php';
//require_once dirname(__FILE__) . '/../../../application/models/Fundraiser.php';

/**
 * Test class for Application_Model_Fundraiser.
 * Generated by PHPUnit on 2011-11-10 at 23:29:36.
 */
class Application_Model_FundraiserTest extends PHPUnit_Framework_TestCase {

   /**
    * @var Application_Model_Fundraiser
    */
   protected $object;

   /**
    * Sets up the fixture, for example, opens a network connection.
    * This method is called before a test is executed.
    */
   protected function setUp() {
      $this->object = new Application_Model_Fundraiser;
   }

   /**
    * Tears down the fixture, for example, closes a network connection.
    * This method is called after a test is executed.
    */
   protected function tearDown() {
      
   }

   public function testGetEntries() {
      //No Fundraiser this month
      $this->assertEquals(false, $this->object->getEntries(2011, 11));
      //Last day is a weekday
      $this->assertEquals(1314748800, $this->object->getEntries(2011, 8)->getTimestamp());
      //Last day is weekend
      $this->assertEquals(1266969600, $this->object->getEntries(2010, 2)->getTimestamp());
   }

}

?>
