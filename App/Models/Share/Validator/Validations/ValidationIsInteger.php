<?php

namespace App\Models\Share\Validator\Validatios;

class ValidationIsInteger extends AbstractValidation{

  public function validate(){

    return ( preg_match('/^\d+$/',$this->value) == 1 ? true : false );

  }

}


?>
