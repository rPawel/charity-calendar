<?php

/**
 * Fundraiser class
 */
class Application_Model_CalendarEntryFundraiser extends Application_Model_CalendarGroupAbstract {

   /**
    * Constructor 
    */
   public function __construct() {
      $this->_setName('Fundraiser');
      $this->_setReoccurent(true);
      $this->_setMonthlyPattern(array(2, 8));
      $this->_setMonthlyDayPattern(-1);
      $this->_setMonthlyExceptionCallback(function($rendered_date) {
                 if ($rendered_date->isWeekDay()) {
                    $result = $rendered_date;
                 } else {
                    $alt_date = new Application_Model_ReoccurenceTemplate($rendered_date->format('Y-m-01'));
                    $result = $alt_date->findNthWeekdayInMonth(3, 1, true);
                 }
                 return $result;
              });
   }
   
}

