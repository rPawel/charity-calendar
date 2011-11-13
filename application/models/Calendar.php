<?php

/**
 * Calendar class
 */
class Application_Model_Calendar extends Application_Model_CalendarAbstract {

   /**
    * Current year of the callendar
    * @var integer 
    */
   private $_year = null;
   
   /**
    * Event groups containing alghoritms to calculate specific dates for a given year
    * @var Application_Model_CalendarGroupList 
    */
   private $_group_list = null;
   
   /**
    * Rendered entries of the specified year
    * @var Application_Model_CalendarEntryList 
    */
   private $_entry_list = null;

   /**
    * Constructor
    */
   public function __construct() {
      $this->_group_list = new Application_Model_CalendarGroupList();
      $this->_entry_list = new Application_Model_CalendarEntryList();
   }

   /**
    * Calendar's year setter
    * 
    * @param integer $year 
    */
   public function setYear($year) {
      $this->_year = $year;
   }

   /**
    * Calendar Group setter
    * 
    * @param Application_Model_CalendarGroupAbstract $group 
    */
   public function addGroup(Application_Model_CalendarGroupAbstract $group) {
      $this->_group_list->append($group);
   }

   /**
    * Retrieves calendar entries from all the callendar's groups
    * 
    * @return Application_Model_CalendarEntryList 
    */
   public function getAgenda() {

      for ($month = 1; $month <= 12; $month++) {
         $this->_group_list->rewind();
         while ($this->_group_list->valid()) {
            $group = $this->_group_list->current();
            $entries = $group->getEntries($this->_year, $month);
            
            if (is_array($entries)) foreach ($entries as $entry) {
               $calendar_entry = array($group->getName(), $entry);
               $this->_entry_list->append($calendar_entry);
            }
            
            $this->_group_list->next();
         }
      }
      return $this->_entry_list;
   }
   
   /**
    * Decorator pattern method
    * 
    * @return Application_Model_CalendarEntryList 
    */
   public function draw() {
      return $this->getAgenda();
   }

}

