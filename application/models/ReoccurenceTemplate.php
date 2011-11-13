<?php

/**
 * Reoccurence template
 */
class Application_Model_ReoccurenceTemplate extends Application_Model_AppDateTime {

   /**
    * Flag used to keep the fact that the offset has to be calculated from the end of the month
    * @var bool 
    */
   private $_reverse = null;

   /**
    * Finds a weekday within given month
    * 
    * @param integer $day 1=Monday,2=Tuesday...
    * @param integer $offset 1=first Monday,2=second Monday...
    * @param bool $reverse If true, offset will be calculated from the end of the month
    * @return Application_Model_AppDateTime 
    */
   function findNthWeekdayInMonth($day, $offset, $reverse = false) { // supply the month, year, day and offset
      $this->_reverse = $reverse;

      $firstDay = $this->_getStartDayOfMonth($reverse);

      $currentStamp = clone $firstDay;
      $results = 0;
      $iteratorFunc = ($reverse ? 'sub' : 'add');
      while ($results != $offset) {
         if (date("N", $currentStamp->getTimestamp()) == $day) {
            $date = clone $currentStamp;
            $results++;
         }
         $currentStamp->$iteratorFunc(new DateInterval('P1D'));
      }
      if (date("n", $date->getTimestamp()) != $this->format('m')) {
         return false;
      } else {
         return $date;
      }
   }

   /**
    * Finds n-th number of the day within a given month
    * 
    * @param integer $day day number of the find, negative number like -1 means last day
    * @return Application_Model_AppDateTime 
    */
   public function findNthDayOfMonth($day) {
      if ($day < 0 ) {
         $iteratorFunc = 'sub';
         $reverse = true;
         $day ++;
      } elseif ($day > 0) {
         $iteratorFunc = 'add';
         $reverse = false;
         $day --;
      } else {
         throw new Zend_Exception('day number can not be 0');
      }
      return $this->_getStartDayOfMonth($reverse)->$iteratorFunc(new DateInterval('P' . abs($day) . 'D'));
   }
   
   
   /**
    * Finds first|last day of the month from a given date
    * 
    * @param bool $reverse
    * @return Application_Model_AppDateTime 
    */
   private function _getStartDayOfMonth($reverse = null) {
      $this->_reverse = $reverse;
      $day = new Application_Model_AppDateTime($this->format('Y') . '-' . $this->format('m') . '-01');
      if ($this->_reverse == true) {
         $day->add(new DateInterval('P1M'));
         $day->sub(new DateInterval('P1D'));
      }
      return $day;
   }

}

