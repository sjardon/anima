<?php

namespace App\Models\Share\Route;


class RouteRunGet extends AbstractRouteRun{

  public function run(){

    $callback = $this->route->getCallback();

    $controller = new $callback[0]($this->request);

    $method = "show";

    if($this->route->getParameters()){
      call_user_func_array(
        Array($controller,$method),
        $this->route->getParametersAsArray()
      );
    }else{
      call_user_func(Array($controller,$method));
    }
  }

}

?>
