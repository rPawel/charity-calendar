<?php

/**
 * Newsletter class
 */
class Application_Model_CalendarEntryNewsletter extends Application_Model_CalendarGroupAbstract {

   /**
    * Constructor
    */
   public function __construct() {
      $this->_setName('Newsletter');
      $this->_setReoccurent(true);
      $this->_setWeekdayPattern(3);
      $this->_setWeekdayPatternOffset(2);
   }

}