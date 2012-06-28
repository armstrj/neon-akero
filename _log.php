<?php

namespace akero\core;

class JALog {
  function say () {
    foreach ( func_get_args() as $arg ) {
      if ( is_array( $arg ) ) {
        echo "<pre>";
        foreach ( $arg as $index => $value ) {
          echo "  ", $index, " => ", $value, "\n";
        }
        echo "</pre>\n";
      }
      else {
        echo $arg;
      }
    } 
  }
}
