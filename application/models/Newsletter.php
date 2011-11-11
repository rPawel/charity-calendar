<?php

class Application_Model_Newsletter extends Application_Model_CalendarGroupAbstract {

   public function __construct() {
      $this->_setName('Newsletter');
   }

   public function getEntries($year, $month) {
      $rt = new Application_Model_ReoccurenceTemplate();
      return $rt->findNthWeekdayInMonth($month, $year, 'Wednesday', 2);
   }

}