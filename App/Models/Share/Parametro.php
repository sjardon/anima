<?php namespace App\Models\Share;

class Parametro{

	private $val;
	private $validador;

	public function __construct($val=false,$validador=false){
		$this->val = $val;
		$this->validadores = $validador;
	}

	public function setVal($val){
		$this->val = $val;
	}

	public function setValidador($validador){
		$this->validador = $validador;
	}

	public function getVal(){
		return $this->val;
	}

	public function getValidador(){
		return $this->validadores;
	}

	public function validar(){
		if($this->validador){
			return $this->validador->validar();
		}

		return true;
	}

	public function toStr(){
		return $this->val;
	}

}


?>
