<?php

namespace Neon\DOM;

class Style extends Element {
  function tag () {
    return 'link';
  }
  function finalise () {
    $this->setAttribute( 'type', 'text/css' );
    $this->setAttribute( 'rel', 'stylesheet' );
  }
}
