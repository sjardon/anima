<?php

namespace App\Life\Processes;

abstract class AbstractProcess{

  protected $next;

  public function __construct(){

  }

  public function setNext(AbstractProcess $process){
    $this->next = $process;
  }

  public function make(\App\Models\share\Http\Request $request){

    //Verifica cosas previas que necesitan todos los procesos.
    // En que casos tendría que devolver un error o seguir operando?
    // Porque hay casos, como algunos errores, en los que va a tener que devolver el response y no seguir procesando.

    $prosessed = $this->processing($request);

    if(!$prosessed && $this->next != false){
        $prosessed = $this->next->make($request);
    }

    return $prosessed;

  }

  abstract protected function processing(\App\Models\share\Http\Request $request);

}

 ?>
