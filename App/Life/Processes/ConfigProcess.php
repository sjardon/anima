<?php

namespace App\Life\Processes;

use \App\Models\Share\Config as Config;

class ConfigProcess extends AbstractProcess{
     // Cargar y ejecutar las configuraciones

     public function processing(\App\Models\share\Http\Request $request){

       Config::add("APP_NAME","Ánima");

       Config::add("DB_CONNECTION","mysql");
       Config::add("DB_HOST","localhost");
       Config::add("DB_USERNAME","santiago");
       Config::add("DB_PASSWORD","123456");

       return false;
     }
}

 ?>
