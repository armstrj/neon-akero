<?php

namespace Neon\DOM;

class Head extends Element {

  private $_style = array();

  function tag () {
    return 'head';
  }

  function finalise () {

    if ( !count( $this->_style ) ) {
      $this->addStyle( '/akero/akero.css' );
    }

    foreach ( $this->_style as $style ) {
      $this->addElement( $style );
    }

    parent::finalise();

  }

  function addStyle ( $file_name ) {
    $this->_style[] = $style = new Style(array( 'src' => $file_name, 'href' => $file_name, ));

  }

}
