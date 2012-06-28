<?php

namespace Neon\Core;

class DatabaseHandle extends Core {

  private $_dbh;
  private $_host;
  private $_user;
  private $_password;
  private $_database;

  function _dbh () {
    if ( !$this->_dbh ) {
      $this->_host      = getConfig('database_host');
      $this->_user      = getConfig('database_user');
      $this->_password  = getConfig('database_password');
      $this->_database  = getConfig('database_name');
      $this->_dbh       = new \mysqli($this->_host, $this->_user, $this->_password, $this->_database );
      if ($this->_dbh->connect_errno) {
          echo "Failed to connect to MySQL: " . $this->_dbh->connect_error;
      }
    }
    return $this->_dbh;
  }

  function quote ( $value ) {
    return "'" . $this->_dbh()->real_escape_string($value) . "'";
  }

  function selectArrayOfHash ( $sql ) {
  }

}
