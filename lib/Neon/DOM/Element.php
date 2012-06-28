<?php

namespace Neon\DOM;

class Element {

private $_root    = null;
private $_content = array();
private $_attr    = array();

private function _addElement( $element ) {
  if ( isset($this->_root) ) {
    $this->_root->addElement( $element );
  }
  else {
    $this->_content[] = $element;
  }
}

function addElement() {
  $args = func_get_args();
  if ( $child_class = $this->child_class() ) {
    foreach ( $args as $arg ) {
      $arg = is_object( $arg ) ? $arg : new $child_class( $arg );
      $this->_addElement( $arg );
    }
  }
  else {
    foreach ( $args as $arg ) {
      $this->_addElement( $arg );
    }
  }
}

function containers () {
  return array( $this->_content );
}

function asHTML( $want_array = 1 ) {

  $this->finalise();

  $html   = array();

  if ( $tag_start = $this->tag_start() ) $html[] = $tag_start;

  foreach ( $this->containers() as $element ) {
    if ( is_object( $element ) ) {
      $html = array_merge( $html, $element->asHTML( WANT_ARRAY ) );
    }
    elseif ( is_array( $element ) ) {
      if ( isset($this->_debug) && $this->_debug ) loghere( $element );
      $html = array_merge( $html, $element );
    }
    else {
      $html[] = "[" . $element . "]";
    }
  }

  if ( $tag_end = $this->tag_end() ) $html[] = $tag_end;

  return $want_array ? $html : join("\n", $html );

}

function initiliase() {
}

function __construct () {

    $this->initiliase();

    foreach ( func_get_args() as $arg ) {
      if ( is_array( $arg ) and !isset($attr) ) {
        $attr = $arg;
        continue;
      }
      $this->addElement( $arg );
    }

    if ( isset($attr) ) {
      $this->setAttributes( $attr );
    }

}

function setAttributes( $attr ) {
  if ( count($attr) ) {
    $this->_attr = array_merge( $this->_attr, $attr );
  }
}

function setAttribute( $attr, $value ) {
  if ( strlen($value) ) {
    $this->_attr[$attr] = $value;
  }
  else {
    unset( $this->_attr[$attr] );
  }
}

function attributes () {
  $attrs = array();
  foreach ( $this->_attr as $name => $value ) {
    $attrs[] = "$name='$value'";
  }
  return join(" ", $attrs );
}


function child_class() {
}

function tag () {
  return '';
}

function tag_start () {
  if ( $tag = $this->tag() ) {
    $attributes = $this->attributes();
    $debug = isset( $this->_debug ) ? $this->_debug : 0;
    return "<" . $tag . ( $attributes ? " $attributes " : "") . ($debug?" ". getBacktrace()." ": "") .  ">";
  }
  return '';
}

function tag_end () {
  if ( $tag = $this->tag() ) {
    $debug = isset( $this->_debug ) ? $this->_debug : 0;
    return "</" . $tag . ($debug ? " ". getBacktrace()." " : '') .">";
  }
  return '';
}

function __toString() {
  return $this->asHTML(0);
}

function finalise() {
}

function setRootElement( $element ) {

  foreach ( $this->_content as $existing ) {
    $element->addElement( $existing );
  }
  $this->_content = array( $element ) ;
  $this->_root    = $element;

}

}
