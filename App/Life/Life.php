<?php

namespace App\Life;

use \App\Models\Share\Http\Request;
use \App\Models\Share\Http\Response;

//Organiza los procesos que se van a dar en la vida, recive una request y devuelve una response.

class Life{

    protected $processes = false;



    public function __construct(){

    }

    public function addProcess($process){
      if($this->processes){
        $process->setNext($this->processes);
      }

      $this->processes = $process;
    }

    public function run(Request $request)
    {
      return $this->processes->make($request);
    }

}

 ?>
