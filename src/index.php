<?php
require_once('Mobile_Detect.php');

$detect = new Detection\Mobile_Detect;

if ( $detect->is('iOS') ) {
  echo "You have an iphone, man!";
}
else if ( $detect->match('HMSCore')) {
  echo "You have a huawei phone, man!";
}
else if ( $detect->is('AndroidOS') ) {
  echo "You have an android phone, man!";
}
else {
  echo "Not a phone, man?";
}
