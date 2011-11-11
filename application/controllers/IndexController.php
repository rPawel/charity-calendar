<?php

class IndexController extends Zend_Controller_Action {

   public function init() {
      /* Initialize action controller here */
   }

//   public function preDispatch() {
//      $this->_helper->layout()->disableLayout();
//      $this->_helper->viewRenderer->setNoRender(true);
//   }

   public function indexAction() {
      $cal = new Application_Model_Calendar();
      $cal->setYear(2012);
      $cal->addGroup(new Application_Model_Fundraiser());
//      $cal->addGroup(new Application_Model_Newsletter());
//      echo "<pre>";print_r ($cal->getAgenda());die;
      
   }
   
   

}

