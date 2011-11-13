<?php

/**
 * CSV Decorator class
 */
class Application_Model_CalendarDecoratorCsv extends Application_Model_CalendarDecoratorAbstract {

   /**
    * Object to decorate
    * @var Application_Model_CalendarAbstract 
    */
   private $_object;

   /**
    * Constructor
    * 
    * @param Application_Model_CalendarAbstract $object 
    */
   public function __construct(Application_Model_CalendarAbstract $object) {
      $this->_object = $object;
   }

   /**
    * toString magic method
    * 
    * @return type 
    */
   public function __toString() {
      return $this->_decorate();
   }

   /**
    * Decorator function which renders the data
    */
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

