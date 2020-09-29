<?php

namespace App\Models\Share\Route;

class Parameter{

  protected $name;
  protected $value;
  protected $validations;

  public function __construct($name=false,$value=false,$validations=false){
    $this->name = $name;
    $this->value = $value;
    $this->validations = $validations;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function setValue($value){
    $this->value = $value;
  }

  public function setValidations($validations){
    $this->validations = $validations;
  }

  public function getName(){
    return $this->name;
  }

  public function getValue(){
    return $this->value;
  }

  public function getValidations(){
    return $this->validations;
  }

}


 ?>
