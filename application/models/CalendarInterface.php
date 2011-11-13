<?php

/**
 * Interface for calendars
 */
interface Application_Model_CalendarInterface {

   /**
    * Decorator pattern method
    * 
    * @return Application_Model_CalendarEntryList 
    */
   public function draw();
}
