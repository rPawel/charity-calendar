<?php

/**
 * CalendarEntry Factory
 */
class Application_Model_CalendarEntry {

   /**
    * Factory of the Calendar Entries
    * 
    * @param string $type
    * @return Application_Model_CalendarEntryFundraiser 
    */
   public static function get($type) {
      switch ($type) {
         case 'Fundraiser':
            return new Application_Model_CalendarEntryFundraiser();
            break;

         case 'Newsletter':
            return new Application_Model_CalendarEntryNewsletter();
            break;

         default:
            throw new Zend_Exception('Calendar entry ' . $type . 'does not exists');
            break;
      }
   }

}

