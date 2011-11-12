<?php

class Application_Model_ReoccurenceTemplate extends Application_Model_AppDateTime {

   private $_reverse = null;

   /**
    *
    * @param string $day 1 (Monday), 2 ...
    * @param integer $offset Nth occurence of the weekday
    * @return type Application_Model_AppDateTime
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

   public function findNthDayOfMonth($day) {
      if ($day < 0 ) {
         $iteratorFunc = 'sub';
         $reverse = true;
         $day ++;
      } else {
         $iteratorFunc = 'add';
         $reverse = false;
      }
      return $this->_getStartDayOfMonth($reverse)->$iteratorFunc(new DateInterval('P' . abs($day) . 'D'));
   }
   
   

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

