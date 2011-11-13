<?php

class IndexController extends Zend_Controller_Action {

   public function init() {
      $this->_helper->viewRenderer->setNoRender();
   }

   public function indexAction() {
      $year = $this->_fetchYear();
      if ($year == NULL)
         die("ERROR: year not specified!\n");

      $cal = new Application_Model_Calendar();
      $cal->setYear($year);

      $fundraisers = Application_Model_CalendarEntry::get('Fundraiser');
      $cal->addGroup($fundraisers);

      $newsletters = Application_Model_CalendarEntry::get('Newsletter');
      $cal->addGroup($newsletters);

      $csv_dec = new Application_Model_CalendarDecoratorCsv($cal);
      file_put_contents(APPLICATION_PATH . '/../public/' . 'output.txt', (string) $csv_dec);
   }
   
   
   private function _fetchYear() {
      $year = null;
      if (Zend_registry::isRegistered('argv')) {
         $argv = Zend_Registry::get('argv');
         if (isset($argv[1]) and is_numeric($argv[1])) {
            $year = $argv[1];
         }
      } else {
         if (isset($_GET['year']) and is_numeric($_GET['year'])) {
            $year = $_GET['year'];
         }
      } 
      return $year;
      
   }

}

