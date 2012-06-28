<?php

namespace Neon\DOM;

class Document extends Element {
  var $_root = null;

  function initialise () {
    $this->setRootElement( $this->root() );
  }

  function xxaddElement() {
    foreach ( func_get_args() as $arg ) {
      $this->root()->addElement( $arg );
    }
  }

  function root () {
    if ( !$this->_root ) {
      $this->_root = new HTML;
    }
    return $this->_root;
  }

  function containers() {
    return array( $this->root(), );
  }


}
