<?

namespace Akero\Controller;

#include_once "lib/Neon/Component/Response.php";
use Neon\Core\Response;
use Neon\MVC;


class Person  {
    function index ( $kernel, $request ) {
        return new Response('<html><body>Hello ' . $request->get('name') .'!</body></html>');
    }

    function read ( $kernel, $request ) {

      $model = $kernel->model();

      $people = $model->find(array(
                  "from"    => "person",
                  "where"   => "nickname like " . $model->quote( $request->getId() ),
                ));
      logHere( "people", $people );

      $response = new Response();

      $response->addElement( "hello" );

      return $response;

      $p = new \Neon\Element\Text( "people" );
      echo $p->asHTML(0);

      return new Response( new \Neon\Element\Text( "people" ), new MVC\TabularResultset( $people ));
    }

}
