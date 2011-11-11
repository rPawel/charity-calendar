<?php

class Application_Model_Fundraiser extends Application_Model_CalendarGroupAbstract {

   public function __construct() {
      $this->_setName('Fundraiser');
   }
   
   public function getEntries($year, $month) {
      if (in_array($month, array(2, 8))) {
         $rt = new Application_Model_ReoccurenceTemplate();
         $day = $rt->findStartDayOfMonth($month, $year, true);
         $rt2 = new Application_Model_ReoccurenceTemplate();
//         echo "Y$year, M$month";
         if ($rt2->isWeekDay($day)) {
            $result = $day;
//            die("is weekday".$day->format("Y-m-d H:i:s"));
         } else {
//            die("is not weekday");
            $rt3 = new Application_Model_ReoccurenceTemplate();
            $result = $rt3->findNthWeekdayInMonth($month, $year, 'Wednesday', 1, true);
         }
      } else {
         $result = false;
      }
      return $result;
   }

}

