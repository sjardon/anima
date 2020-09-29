<?php namespace App\Controllers;

abstract class AbstractController{
  protected $request;
  protected $usuario;

  public function __construct($request=false,$usuario = false){
    $this->request = $request;
    $this->usuario = $usuario;
  }

  public function setRequest($request){
    $this->request = $request;
  }

  public function setUsuario($usuario){
    $this->usuario = $usuario;
  }

  public function getRequest(){
    return $this->request;
  }

  public function getUsuario(){
    return $this->usuario;
  }

  abstract public function show();
  abstract public function store();
  abstract public function update();
  abstract public function destroy();


}
