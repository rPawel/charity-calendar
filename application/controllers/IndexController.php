<?php

class IndexController extends Zend_Controller_Action {

   public function init() {
//      $this->_helper->layout()->disableLayout();
//      $this->_helper->viewRenderer->setNoRender();
   }

   public function indexAction() {
      $cal = new Application_Model_Calendar();
      $cal->setYear(2012);

      $fundraisers = Application_Model_CalendarEntry::get('Fundraiser');
      $cal->addGroup($fundraisers);

      $newsletters = Application_Model_CalendarEntry::get('Newsletter');
      $cal->addGroup($newsletters);

      $csv_dec = new Application_Model_CalendarDecoratorCsv($cal);
      file_put_contents(APPLICATION_PATH . '/../public/' . 'output.txt', (string) $csv_dec);
   }

}

