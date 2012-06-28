<?php

namespace Neon\Core;

class Router {

  function getControllerClass( $kernel, $request ) {
    return "Akero\\Controller\\" . ucwords( $request->getNoun() );
  }

  function getControllerAction( $kernel, $request ) {
    return $request->getVerb();
  }

}
