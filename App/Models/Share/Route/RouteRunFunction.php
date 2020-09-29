<?php

namespace App\Models\Share\Route;


class RouteRunFunction extends AbstractRouteRun{

  public function run(){

    if($this->route->getParameters()){
      call_user_func_array(
        $this->route->getCallback(),
        $this->route->getParametersAsArray()
      );
    }else{
      call_user_func($this->route->getCallback());
    }
  }

}

?>
