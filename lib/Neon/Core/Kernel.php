<?php

namespace Neon\Core;

class Kernel {
  function run () {
    # instantiate request
    # instantiate controller
    # response = controller->action( kernel, request );
    # echo response->asHTML();

    $request    = $this->get('request');
    $router     = $this->get('router');

    $controller_class   = $router->getControllerClass( $this, $request );
    $controller_action  = $router->getControllerAction( $this, $request );

    #logHere( "kernel: ", $controller_class, "->", $controller_action, "( ", /*$request->getId(),*/ " )" );

    $controller = new $controller_class( $kernel, $request );
    $response = $controller->$controller_action( $this, $request );

    $response->render();



  }

  function get ( $what, $args = array() ) {
    $args['kernel'] = $this;
    return getInstance( $what, $args );
  }

  function log () {
    return $this->get('log');
  }

  function request () {
    return $this->get('request');
  }

  function response () {
    return $this->get('response');
  }

  function model () {
    return $this->get('model');
  }


}
