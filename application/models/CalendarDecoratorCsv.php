<?php

class Application_Model_CalendarDecoratorCsv extends Application_Model_CalendarDecoratorAbstract {

   private $_object;

   public function __construct(Application_Model_CalendarAbstract $object) {
      $this->_object = $object;
   }

   public function __toString() {
      return $this->_decorate();
   }

   private function _decorate() {

      try {
         $out = null;
         $data = $this->_object->draw();
//            echo "<pre>" . print_r($data);die;
         foreach ($data as $entry) {
//            echo "<pre>" . print_r($entry);die;
            $out .= sprintf('"%s","%s"', $entry[0], $entry[1]->format('Y-m-d')) . "\n";
         }
//         print_r($out);die;
         return $out;
      } catch (Exception $exc){
         echo $exc->getTraceAsString();
      }

   }

}

