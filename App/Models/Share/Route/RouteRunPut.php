<?php

namespace App\Models\Share\Route;


class RouteRunPut extends AbstractRouteRun{

  public function run(){
    $callback = $this->route->getCallback();

    $controller = new $callback[0]($this->request);

    $method = "update";

    if($this->route->getParameters()){
      return call_user_func_array(
        Array($controller,$method),
        $this->route->getParametersAsArray()
      );
    }else{
      return call_user_func(Array($controller,$method));
    }
  }

}


?>
