<?php

namespace App\Life\Processes;

use \App\Models\Share\Route as Route;
use \App\Models\Share\Router as Router;



class RoutesProcess extends AbstractProcess{
  // Cargar las rutas

  public function processing(\App\Models\share\Http\Request $request){

    $response = false;
    // |        | POST      | api/courses                             | courses.store                     | App\Http\Controllers\CourseController@store                               | api        |
    // |        |           |                                         |                                   |                                                                           | auth:api   |
    // |        | GET|HEAD  | api/courses                             | courses.index                     | App\Http\Controllers\CourseController@index                               | api        |
    //  DELETE    | api/courses/{course}                    | courses.destroy                   | App\Http\Controllers\CourseController@destroy                             | api        |
    //
    //  PUT|PATCH | api/courses/{course}                    | courses.update                    | App\Http\Controllers\CourseController@update                              | api        |
    //
    //  GET|HEAD  | api/courses/{course}                    | courses.show                      | App\Http\Controllers\CourseController@show                                | api        |

    $routes = Array(
      new Route('/tests/{test}','TestController'),
      new Route('/tests/{test}/testers/','TestController'),
      new Route('/tests/{test}/testers/{tester}','TestController')
    );

    $router = new Router($routes,$request);
    $route = $router->matchRoute();

    if($route){
      $response = $route->run($request);
    }
    


    return $response;
  }
}

?>
