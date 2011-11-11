<?php

class Application_Model_ReoccurenceTemplate {

   private $_reverse = null;
   private $_year = null;
   private $_month = null;

   /**
    *
    * @param integer $month 
    * @param integer $year
    * @param string $day Saturday|Monday|...
    * @param integer $offset Nth occurence of the weekday
    * @return type DateTime
    */
   function findNthWeekdayInMonth($month, $year, $day, $offset, $reverse = false) { // supply the month, year, day and offset
      $this->_reverse = $reverse;
      $this->_year = $year;
      $this->_month = $month;

      $firstDay = $this->_getStartDayOfMonth();

      $currentStamp = clone $firstDay;
      $results = 0;
      $iteratorFunc = ($reverse ? 'sub' : 'add');
      while ($results != $offset) {
         if (date("l", $currentStamp->getTimestamp()) == $day) {
            $date = clone $currentStamp;
            $results++;
         }
         $currentStamp->$iteratorFunc(new DateInterval('P1D'));
      }
      if (date("n", $date->getTimestamp()) != $month) {
         return false;
      } else {
         return $date;
      }
   }

   public function isWeekDay(DateTime $day) {
      return !in_array(date("l", $day->getTimestamp()), array('Saturday', 'Sunday'));
   }

   public function findStartDayOfMonth($month, $year, $reverse = false) {
      $this->_reverse = $reverse;
      $this->_year = $year;
      $this->_month = $month;
      return $this->_getStartDayOfMonth();
   }

   private function _getStartDayOfMonth() {
      $day = new DateTime($this->_year . '-' . $this->_month . '-01');
      if ($this->_reverse !== true) {
         return $day;
      } else {
         return $day->add(new DateInterval('P1M'))->sub(new DateInterval('P1D'));
      }
   }

}

