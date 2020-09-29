<?php

namespace App\Life;

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

    public function run(\App\Models\share\Http\Request $request){
      $this->processes->make($request);
    }

}

 ?>
