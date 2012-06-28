<?php

namespace Neon\DOM;

class Body extends Element {

  function tag () {
    return 'body';
  }

  function child_class() {
    return "\Neon\DOM\Paragraph";
    return "\Neon\DOM\Div";
  }

  function finalise() {
    $div = new Div;
    $div->setAttribute( 'class', 'content' );
    $this->setRootElement( $div );
  }

}
