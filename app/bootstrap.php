<?php


$CLASS_DEFN = array(
  'log'             => array( 'class_name' => 'Neon\Core\Log',        ),
  'kernel'          => array( 'class_name' => 'Neon\Core\Kernel',     ),
  'request'         => array( 'class_name' => 'Neon\Core\Request',    ),
  'response'        => array( 'class_name' => 'Neon\Core\Response',   ),
  'router'          => array( 'class_name' => 'Neon\Core\Router',   ),

  'model'           => array( 'class_name' => 'Neon\MVC\Model',       ),
  'view'            => array( 'class_name' => 'Neon\MVC\View',        ),
  'controller'      => array( 'class_name' => 'Neon\MVC\Controller',  ),

);

function getInstance ( $what, $arg = array() ) {

  static $instance = array();

  if ( !array_key_exists($what, $instance) ) {
    global $CLASS_DEFN;
    if ( array_key_exists( $what, $CLASS_DEFN ) and $defn = $CLASS_DEFN[$what] ) {
      #$class_file = './lib/' . str_replace('\\','/', $defn['class_name'] ) . '.php';
      #include_once $class_file;
      #echo "included $class_file</br>\n";
      $instance[$what] = new $defn['class_name'] ( $arg );
    }
    else {
      throw new Exception("Unknown servce [$what]");
    }
  }
  return $instance[$what];

}

function getBacktrace () {
  $backtrace = debug_backtrace();
  array_shift( $backtrace );
  $trace = array();

  foreach ( $backtrace as $level ) {
    $descr = array();
    if ( array_key_exists( 'file', $level ) ) {
      $descr[] = substr($level['file'],15, strlen( $level['file'] )-19 );
      #$descr[] = $level['file'];
      $descr[] = $level['line'];
    }
    else {
      continue;
    }
    if ( array_key_exists( 'class', $level ) ) {
      $descr[] = $level['class'];
    }
    if ( array_key_exists( 'function', $level ) ) {
      $descr[] = $level['function'];
    }
    $trace[] = join(":", $descr);
  }
  return join(" - ", array_reverse( $trace ));
}

$_LOG = array();

function logHere () {
  global $_LOG;
  $args = func_get_args();
  $message = join('', array(
    "<div class='log'>",
      "<div class='backtrace'>", getBacktrace(), "</div>"));

  foreach ( func_get_args() as $arg ) {
    #echo dump( $arg ), " ";
    $message .=  dump( $arg ) . " ";
  }

  $message .= "</div>";

  $_LOG[] = $message;

}

function dump ( $arg ) {
  $type = gettype( $arg );
  if ( is_scalar( $arg ) ) {
    return $arg;
  }
  elseif ( $type == 'array' ) {
    #$td_style = "style='border:1px solid grey; padding: 2px 0.5em; '";
    $html = array();
    if ( count( $arg ) ) {
      $html[] = "<table >";
      foreach ( $arg as $name => $value ) {
        $html[] = "<tr><td>$name</td><td>" . dump( $value ) . "</td></tr>";
      }
      $html[] = "</table>";
    }
    else {
      $html[] = "<i>empty array</i>";
    }
    return join("\n", $html );
  }
  elseif( $type == 'object' ) {
    $html = array();
    $html[] = "Object: " . get_class( $arg );
    $html[] = dump( (array) $arg );
    return join("\n", $html );
  }
  elseif ( $type == 'NULL' ) {
    return "<i>null</i>";
  }

  return "$arg";
}

spl_autoload_register(
  function($class) {
      $file_name = strtr($class, '_\\', '//') . '.php';
      foreach (array( './app/', './lib/' ) as $path ) {
        if ( is_file( $path . $file_name ) ) {
          #loghere( "require: ", $path . $file_name );
          require_once $path . $file_name;
        }
      }
    }
  );



