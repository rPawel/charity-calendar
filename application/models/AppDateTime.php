<?php

class Application_Model_AppDateTime extends DateTime
{
   public function isWeekDay() {
      return !in_array(date("w", $this->getTimestamp()), array(0, 6));
   }


}

