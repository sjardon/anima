<?php

namespace App\Config;


class Autoload {

  public function load(){

    spl_autoload_register(function($class){
      $ruta = str_replace("\\","/",$class) . ".php";

      include_once($ruta);
    });
  }

}

?>
