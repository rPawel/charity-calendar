<?php

class Application_Model_CalendarDecoratorCsv extends Application_Model_CalendarDecoratorAbstract {

   private $_object;

   public function __construct(Application_Model_CalendarAbstract $object) {
      $this->_object = $object;
   }

   public function __toString() {
      return $this->_decorate();
   }

   public function _decorate() {

      try {
         $out = null;
         $data = $this->_object->draw();
         foreach ($data as $entry) {
            $out .= sprintf('"%s","%s"', $entry[0], $entry[1]->format('Y-m-d')) . "\n";
         }
         return $out;
      } catch (Exception $exc){
         echo $exc->getTraceAsString();
      }

   }

}

