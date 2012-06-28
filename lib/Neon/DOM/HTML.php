<?php

namespace Neon\DOM;

class HTML extends Element {
  var $_head = null;
  var $_body = null;

  function tag () {
    return 'html';
  }

  function addElement() {
    foreach ( func_get_args() as $arg ) {
      $this->body()->addElement( $arg );
    }
  }

  function body () {
    if ( !$this->_body ) {
      $this->_body = new Body;
    }
    return $this->_body;
  }

  function head () {
    if ( !$this->_head ) {
      $this->_head = new Head;
    }
    return $this->_head;
  }

  function containers() {
    return array( $this->head(), $this->body(), );
  }

}
