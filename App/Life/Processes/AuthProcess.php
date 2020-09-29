<?php

namespace App\Life\Processes;


class AuthProcess extends AbstractProcess{
     // Cargar y ejecutar las configuraciones

     public function processing(\App\Models\share\Http\Request $request){
       if($request->getToken()){
         // echo $request->getToken()."<br>";
       }else{
         // echo "No hay token";
       }

     }
}

 ?>
