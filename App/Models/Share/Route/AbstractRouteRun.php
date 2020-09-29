<?php

namespace App\Models\Share\Route;

use \App\Models\Share\Http\Request as Request;
use \App\Models\Share\Route as Route;

abstract class AbstractRouteRun{

  protected $route;
  protected $request;

  public function __construct(Route $route,Request $request){
    $this->route = $route;
    $this->request = $request;
  }

  abstract public function run();

}

 ?>
