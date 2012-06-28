<?php

namespace Neon\Element;

class Element {

private $_dom = array();

function addElement() {
  $this->_dom = array_merge( $this->_dom, func_get_args() );
  #foreach ( $this->_dom as $index => $value ) {
    #echo "  ", $index, " => ", "[", $value, "]", "<br>\n";
  #}

}

function getElements() {
  $elements = $this->_dom;
  return $elements;
}


function xxasHTML( $want_array ) {
  return $want_array ? $this->_dom : join("", $this->_dom );
}

function asHTML( $want_array ) {

  $html = array();

  foreach ( $this->_dom as $element ) {
    if ( is_object( $element ) ) {
      $html = array_merge( $html, $element->asHTML( WANT_ARRAY ) );
    }
    elseif ( is_array( $element ) ) {
      $html = array_merge( $html, $element );
    }
    else {
      $html[] = $this->tag_start() . $element . $this->tag_end() ;
    }
  }

  return $want_array ? $html : join("\n", $html );

}

function __construct () {

    foreach ( func_get_args() as $arg ) {
      if ( is_scalar( $arg ) ) {
        $this->addElement( $arg );
      }
      else  {
        echo "warning: not scalar", $arg, "<br>\n";
      }
    }

}

function tag () {
  return '';
}

function tag_start () {
  if ( $tag = $this->tag() ) {
    return "<" . $tag . ">";
  }
  return '';
}

function tag_end () {
  if ( $tag = $this->tag() ) {
    return "</" . $tag . ">";
  }
  return '';
}

}
