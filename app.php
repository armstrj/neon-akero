<?php
  ini_set("display_errors", 1);
  include_once("./app/bootstrap.php");
  
  getInstance('kernel')->run();
  
  #getInstance('log')->say(
  #    $_SERVER['PHP_SELF'],
  #    " ", $_REQUEST
  #  );
  #
  #phpinfo();


