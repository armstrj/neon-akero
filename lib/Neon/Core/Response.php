<?php

namespace Neon\Core;

define( 'WANT_ARRAY', 1 );

use Neon\DOM;

class Response extends DOM\Document {

  function __construct () {

    foreach ( func_get_args() as $arg ) {
      #logHere( $arg );
      $this->addElement( $arg );
    }

  }

  function render () {
    echo $this->asHTML( 0 );

  }


}
