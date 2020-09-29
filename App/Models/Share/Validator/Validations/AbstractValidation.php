<?php

namespace App\Models\Share\Validator\Validatios;

abstract class AbstractValidation{

  protected $value;

  public function __construct($value=false){
    $this->value = $value;
  }

  public function setValue($value){
    $this->value = $value;
  }

  public function getValue(){
    return $this->value;
  }

  abstract public validate();
}

?>
