<?php

namespace Neon\MVC;

class TabularResultset {
  private $_resultset;

  function __construct( $resultset = null ) {
    if ( $resultset ) {
      $this->_resultset = $resultset;
    }
  }

  function asHTML () {
    echo "<pre>", var_dump( $this->_resultset ), "</pre>";
  }

}
