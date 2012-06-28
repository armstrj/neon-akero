<?php

namespace Neon\MVC;
use Neon\Core\Core;
use Neon\Core\DatabaseHandle;

class Model extends Core {

  private $_dbh;

  function __construct () {
    logHere( "called ", __CLASS__, "->", __FUNCTION__, func_get_args() );
  }

  function find ( $arg  ) {
    return new ResultSet( $this->dbh()->selectArrayOfHash( new SQLStatement( $arg ) ));
  }

  function quote( $value ) {
    return $this->dbh()->quote( $value );
  }

  function dbh () {
    if ( !$this->_dbh ) {
        $this->_dbh = new DatabaseHandle();
    }
    return $this->_dbh;
  }

}
