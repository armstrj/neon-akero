<?php
namespace Neon\Core;

class Request extends Core {

  private $_parsed = null;

  private static $KNOWN_VERB = array(
                  'index'   => 1,
                  'search'  => 1,
                  'edit'    => 1,
                  );


  private function _getVerb( $word ) {
    $word = strtolower( $word );
    if ( $word == 'index'   ) return $word;
    if ( $word == 'create'  ) return $word;
    if ( $word == 'read'    ) return $word;
    if ( $word == 'show'    ) return $word;
    if ( $word == 'update'  ) return $word;
    if ( $word == 'delete'  ) return $word;
    return '';
  }

  private function _parse( $part = '' ) {
    if ( !$this->_parsed ) {
      $parts = preg_split("/\W+/", $_SERVER['REQUEST_URI'], 0, PREG_SPLIT_NO_EMPTY );
      #logHere( "[" . join("] [", $parts ) . "]" );
      $this->_parsed['app']   = array_shift( $parts );
      $this->_parsed['noun']  = array_shift( $parts );

      if ( count($parts) >= 2 and $verb = $this->_getVerb( $parts[0] ) ) {
        $this->_parsed['verb'] = $verb;
        $this->_parsed['id']   =  $parts[1];
      }
      elseif ( count( $parts ) ) {
        $this->_parsed['id']   =  array_shift( $parts );
      }
      if ( !array_key_exists( 'verb', $this->_parsed ) ) {
        $this->_parsed['verb'] = 'index';
      }

    }
    if ( $part ) {
      return array_key_exists( $part, $this->_parsed ) ? $this->_parsed[$part] : null;
    }
  }

  function getNoun() {
    return $this->_parse('noun');
  }

  function getVerb() {
    return $this->_parse('verb');
  }

  function getId() {
    return $this->_parse('id');
  }

  function get ( $token ) {
    return array_key_exists( $token, $_REQUEST ) ? $_REQUEST[$token] : null;
  }



}
