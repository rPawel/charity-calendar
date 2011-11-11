<?php

class Application_Model_Calendar {

   private $_year = null;
   private $_group_list = null;
   private $_entry_list = null;

   public function __construct() {
      $this->_group_list = new Application_Model_CalendarGroupList();
      $this->_entry_list = new Application_Model_CalendarEntryList();
   }

   public function setYear($year) {
      $this->_year = $year;
   }

   public function addGroup(Application_Model_CalendarGroupAbstract $group) {
      $this->_group_list->append($group);
   }

   public function getAgenda() {
      echo "I have " . $this->_group_list->count() . " groups\n";

      for ($month = 1; $month <= 12; $month++) {
         echo "Month:" . $month . "\n";
         $this->_group_list->rewind();
         while ($this->_group_list->valid()) {
            $group = $this->_group_list->current();
            $entry = $group->getEntries($this->_year, $month);
            if ($entry) {
               echo "Entry:" . $entry->format('Y-m-d H:i:s') . "\n";
               $this->_entry_list->append($entry);
            }
            $this->_group_list->next();
         }
      }
      return $this->_entry_list;
   }

}

