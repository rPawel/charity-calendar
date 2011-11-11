<?php

abstract class Application_Model_CalendarGroupAbstract implements Application_Model_CalendarGroupInterface{

   protected $_name;
   
   protected function _getName() {
      return $this->_name;
   }

   protected function _setName($name) {
      $this->_name = $name;
   }


}

