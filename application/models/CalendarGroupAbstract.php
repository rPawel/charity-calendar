<?php

/**
 * Calendar groups abstract class
 */
abstract class Application_Model_CalendarGroupAbstract implements Application_Model_CalendarGroupInterface {

   
   /**
    * Rendered dates of the calendar group
    * @var array|null 
    */
   protected $_rendered_dates = null;
   
   /**
    * Name of the calendar group
    * @var string 
    */
   protected $_name = null;
   
   /**
    * Reoccurent flag
    * @var bool|null
    */
   protected $_reoccurent = null;
   
   /**
    * Months in which event occurs
    * @var array|null 
    */
   protected $_monthly_pattern = null;
   
   /**
    * Day number in which event occur
    * @var integer|null
    */
   protected $_monthly_day_pattern = null;
   
   /**
    * Weekdays in which event occurs
    * @var array|null
    */
   protected $_weekday_pattern = null;
   
   /**
    * N-th occurence of the weekday, e.g: 2nd Monday
    * @var integer|null 
    */
   protected $_weekday_pattern_offset = null;
   
   /**
    * Custom function which allows modyfing events occuring monthly
    * @var closure|null
    */
   protected $_monthly_exception_callback = null;

   /**
    * Name getter
    * 
    * @return string 
    */
   public function getName() {
      return $this->_name;
   }

   /**
    * Name getter
    * 
    * @return string 
    */
   protected function _getName() {
      return $this->_name;
   }

   /**
    * Name setter
    * 
    * @return string 
    */
   protected function _setName($name) {
      $this->_name = $name;
      return $this;
   }

   /**
    * Reoccurence getter
    * 
    * @return bool 
    */
   protected function _getReoccurent() {
      return $this->_reoccurent;
   }

   /**
    * Reoccurence setter
    * 
    * @return Application_Model_CalendarGroupAbstract 
    */
   protected function _setReoccurent($reoccurent = true) {
      $this->_reoccurent = $reoccurent;
      return $this;
   }

   /**
    * Weekday pattern getter
    * 
    * @return array|null 
    */
   protected function _getWeekdayPattern() {
      return $this->_weekday_pattern;
   }

   /**
    * Weekday pattern setter
    * 
    * @param integer|array $weekday_pattern
    * @return Application_Model_CalendarGroupAbstract 
    */
   protected function _setWeekdayPattern($weekday_pattern) {
      if (!is_array($weekday_pattern)) {
         $weekday_pattern = array($weekday_pattern);
      }
      $this->_weekday_pattern = $weekday_pattern;
      return $this;
   }

   /**
    * Monthly day pattern
    * 
    * @return integer|null 
    */
   protected function _getMonthlyDayPattern() {
      return $this->_monthly_day_pattern;
   }

   /**
    * Monthly day pattern setter
    * 
    * @param type $monthly_day_pattern
    * @return Application_Model_CalendarGroupAbstract 
    */
   protected function _setMonthlyDayPattern($monthly_day_pattern) {
      $this->_monthly_day_pattern = $monthly_day_pattern;
      return $this;
   }

   /**
    * Weekday pattern offset getter
    * 
    * @return integer|null 
    */
   protected function _getWeekdayPatternOffset() {
      return $this->_weekday_pattern_offset;
   }

   /**
    * Weekday pattern offset getter
    * 
    * @param integer|null $weekday_pattern_offset
    * @return Application_Model_CalendarGroupAbstract 
    */
   protected function _setWeekdayPatternOffset($weekday_pattern_offset) {
      $this->_weekday_pattern_offset = $weekday_pattern_offset;
      return $this;
   }

   /**
    * Monthly pattern getter
    * 
    * @return array|null 
    */
   protected function _getMonthlyPattern() {
      return $this->_monthly_pattern;
   }

   /**
    * Monthly pattern setter
    * 
    * @param array|null $monthly_pattern
    * @return Application_Model_CalendarGroupAbstract 
    */
   protected function _setMonthlyPattern($monthly_pattern) {
      $this->_monthly_pattern = $monthly_pattern;
      return $this;
   }

   /**
    * Monthly exception callback function getter
    * 
    * @return closure 
    */
   protected function _getMonthlyExceptionCallback() {
      return $this->_monthly_exception_callback;
   }

   /**
    * Monthly exception callback function setter
    * 
    * @param closure $monthly_exception_callback
    * @return Application_Model_CalendarGroupAbstract 
    */
   protected function _setMonthlyExceptionCallback($monthly_exception_callback) {
      $this->_monthly_exception_callback = $monthly_exception_callback;
      return $this;
   }

   /**
    * Retrives generated date entries for specific year and month
    * 
    * @param type $year Requested year
    * @param type $month Requested month
    * @return array 
    */
   public function getEntries($year, $month) {
      $this->_rendered_dates = array();
      if ((is_array($this->_monthly_pattern) && in_array($month, $this->_monthly_pattern)) || ($this->_monthly_pattern == NULL)) {

         if ($this->_monthly_day_pattern !== NULL) {
            $this->_rendered_dates[] = $this->_getMonthlyDayPatternEntries($year, $month);
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
   
   /**
    * Monthly day pattern entries getter
    * 
    * @param integer $year
    * @param integer $month
    * @return Application_Model_AppDateTime 
    */
   private function _getMonthlyDayPatternEntries($year, $month) {
      $rt = new Application_Model_ReoccurenceTemplate("$year-$month-01");
      $rendered_date = $rt->findNthDayOfMonth($this->_monthly_day_pattern);
      
      if ($this->_monthly_exception_callback) {
         $callback = $this->_monthly_exception_callback;
         $rendered_date = $callback($rendered_date);
      }
      return $rendered_date;
      
   }

}

