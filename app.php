<?php

  # front-controller...

  ini_set("display_errors", 1);
  include_once("./app/bootstrap.php");
  include_once("./app/secrets.php");

  getInstance('kernel')->run();

