<?php

/**
 * DateTime extended class
 */
class Application_Model_AppDateTime extends DateTime
{
   /**
    * Checks whether day is a working week day of weekend day
    * @return bool 
    */
   public function isWeekDay() {
      return !in_array(date("w", $this->getTimestamp()), array(0, 6));
   }


}

