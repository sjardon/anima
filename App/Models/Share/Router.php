<?php

namespace App\Models\Share;

class Router{

  protected $routes;
  protected $request;

  public function __construct($routes=false,$request=false){
    $this->routes = $routes;
    $this->request = $request;
  }

  public function setRoutes($routes){
    $this->routes = $routes;
  }

  public function getRoutes(){
    return $this->routes;
  }

  public function setRequest($request){
    $this->request = $request;
  }

  public function getRequest(){
    return $this->request;
  }

  public function matchRoute(){

    if(is_array($this->routes)){
      foreach($this->routes as $i => $route){

        //Compruebo que tengan la misma cantidad de parámetros

        if(count($route->getUri())!=count($this->request->getUri())){

          continue;
        }

        //Compruebo que los nombres de los recursos sean los mismos

        $invalidUri = false;

        foreach($route->getUri() as $j => $resourse){

          if($route->isParameter($resourse)){
            continue;
          }

          $requestUri = $this->request->getUri();

          if($resourse != $requestUri[$j]){
            $invalidUri = true;
            break;
          }
        }

        if($invalidUri){
          continue;
        }

        return $route;
      }
    }

    return false;
  }

}

?>
