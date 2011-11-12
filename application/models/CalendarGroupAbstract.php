<?php

abstract class Application_Model_CalendarGroupAbstract implements Application_Model_CalendarGroupInterface {

   protected $_rendered_dates = null;
   protected $_name = null;
   protected $_reoccurent = null;
   protected $_monthly_pattern = null;
   protected $_monthly_day_pattern = null;
   protected $_weekday_pattern = null;
   protected $_weekday_pattern_offset = null;
   protected $_monthly_exception_callback = null;

   public function getName() {
      return $this->_name;
   }

   protected function _getName() {
      return $this->_name;
   }

   protected function _setName($name) {
      $this->_name = $name;
      return $this;
   }

   protected function _getReoccurent() {
      return $this->_reoccurent;
   }

   protected function _setReoccurent($reoccurent = true) {
      $this->_reoccurent = $reoccurent;
      return $this;
   }

   protected function _getWeekdayPattern() {
      return $this->_weekday_pattern;
   }

   protected function _setWeekdayPattern($weekday_pattern) {
      if (!is_array($weekday_pattern)) {
         $weekday_pattern = array($weekday_pattern);
      }
      $this->_weekday_pattern = $weekday_pattern;
      return $this;
   }

   protected function _getMonthlyDayPattern() {
      return $this->_monthly_day_pattern;
   }

   protected function _setMonthlyDayPattern($monthly_day_pattern) {
      $this->_monthly_day_pattern = $monthly_day_pattern;
      return $this;
   }

   protected function _getWeekdayPatternOffset() {
      return $this->_weekday_pattern_offset;
   }

   protected function _setWeekdayPatternOffset($weekday_pattern_offset) {
      $this->_weekday_pattern_offset = $weekday_pattern_offset;
      return $this;
   }

   protected function _getMonthlyPattern() {
      return $this->_monthly_pattern;
   }

   protected function _setMonthlyPattern($monthly_pattern) {
      $this->_monthly_pattern = $monthly_pattern;
      return $this;
   }

   protected function _getMonthlyExceptionCallback() {
      return $this->_monthly_exception_callback;
   }

   protected function _setMonthlyExceptionCallback($monthly_exception_callback) {
      $this->_monthly_exception_callback = $monthly_exception_callback;
      return $this;
   }

   public function getEntries($year, $month) {
      $this->_rendered_dates = array();
      if (is_array($this->_monthly_pattern) && in_array($month, $this->_monthly_pattern)) {

         if ($this->_monthly_day_pattern) {
            $rt = new Application_Model_ReoccurenceTemplate("$year-$month-01");
            $rendered_date = $rt->findNthDayOfMonth($this->_monthly_day_pattern);
            if ($this->_monthly_exception_callback) {
               $callback = $this->_monthly_exception_callback;
               $this->_rendered_dates[] = $callback($rendered_date);
            } else {
               $this->_rendered_dates[] = $rendered_date;
            }
         }

         if (is_array($this->_weekday_pattern)) {
            foreach ($this->_weekday_pattern as $weekday_pattern) {
               $rt = new Application_Model_ReoccurenceTemplate("$year-$month-01");
               //@TODO: modify if there would be a need for instance far ALL MONDAYS AND TUESDAYS within a month
               $rendered_date = $rt->findNthWeekdayInMonth($weekday_pattern, $this->_weekday_pattern_offset);
               $this->_rendered_dates[] = $rendered_date;
            }
         }
      }
      return $this->_rendered_dates;
      
   }

}

