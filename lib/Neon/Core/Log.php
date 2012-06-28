<?php

namespace Neon\Core;
include_once "Core.php";

class Log extends Core {

  private $_lines = array();
  
  function say () {
    foreach ( func_get_args() as $arg ) {
      if ( is_array( $arg ) ) {
        echo "<pre>";
        foreach ( $arg as $index => $value ) {
          echo "  ", $index, " => ", $value, "\n";
          $this->_lines[] = array( "  ", $index, " => ", $value, );
        }
        echo "</pre>\n";
      }
      else {
        echo $arg;
        $this->_lines[] = array( $arg );

      }
    }
    echo "</br>\n";
 
  }
  
  function asHTML () {
    $html = array();
    $html[] = "<div style='whitespace: pre; border: 1px solid #ccc; font-style: italic; padding: 2px 2px 2px 4px ; color: #808080; background-color: #eee; '>";
    if ( count( $this->_lines ) ) {
      foreach ( $this->_lines as $parts ) {
        foreach ( $parts as $string ) {
          $html[] = $string . "\n";
        }
      }
    }
    else {
      $html[] = "No logs.\n";
    }
    $html[] = "</div>\n";
    return $html;
  }
}
