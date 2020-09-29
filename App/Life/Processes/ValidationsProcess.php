<?php
namespace App\Life\Processes;

use \App\Models\Share\Route as Route;
use \App\Models\Share\Router as Router;

use \App\Models\Share\Validator as Validator;


class ValidationsProcess extends AbstractProcess{

  // Cargar los validadores

  public function processing(\App\Models\share\Http\Request $request){
    
    $validations = Validator\Validations::getInstance();
    $validations->add("integer","\App\Models\Share\Validator\Validations\ValidationIsInteger");

    return false;
  }

}



?>
