<?php

/**
 * Interface for calendar groups
 */
interface Application_Model_CalendarGroupInterface {

   /**
    * Retrieves entries for the specific month and year
    * 
    * @param integer year Requested year
    * @param integer month Requested month
    * @return array
    */
   public function getEntries($year, $month);
   
}

