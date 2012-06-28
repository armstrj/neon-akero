<?php

namespace Neon\Core;

class Core {

  private static $_kernel;

  function __construct ( $arg=array() ) {
    if ( array_key_exists('kernel', $arg) ) {
      $this->_kernel = $arg['kernel'];
    }
  }
  
  function kernel () {
    return $this->_kernel;
  }

  

}
