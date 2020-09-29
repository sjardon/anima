<?php namespace App\Models\Share;

class Val{
	protected $dato = false;
	protected $mensaje = false;

	public function __construct($unDato, $unMensaje){
		$this->dato = $unDato;
		$this->mensaje = $unMensaje;
	}

	//Setters
	public function setDato($unDato){
		$this->dato = $unDato;
	}

	public function setMensaje($unMensaje){
		$this->mensaje = $unMensaje;
	}

	//Getters

	public function getDato(){
		return $this->dato;
	}

	public function getMensaje(){
		return $this->mensaje;
	}
}

class ValRequerido extends Val{

	//Validar

	public function validar(){
		//Devuelve true si el dato ingresado esta completo
		// se considera que es vacio si dato = 0 para php, por eso se comprueba que sea != 0

		if($this->dato!=0){
			if($this->dato == "" OR $this->dato == false){
				return false;
			}
		}

		return true;
	}
}

class ValMinCaracteres extends Val{
	private $cant = false;

	public function __construct($unDato, $unMensaje,$unaCantidad){
		$this->dato = $unDato;
		$this->mensaje = $unMensaje;
		$this->cant = $unaCantidad;
	}

	public function setCant($unaCantidad){
		$this->cant = $unaCantidad;
	}

	public function getCant(){
		return $this->cant;
	}

	//Validar

	public function validar(){
		//Comprueba que tenga un minimo de $this->cant caracteres
		if(strlen($this->dato) >= $this->cant){
			return true;
		}

		return false;
	}
}

class ValMaxCaracteres extends Val{

	private $cant = false;

	public function __construct($unDato, $unMensaje,$unaCantidad){
		$this->dato = $unDato;
		$this->mensaje = $unMensaje;
		$this->cant = $unaCantidad;
	}

	public function setCant($unaCantidad){
		$this->cant = $unaCantidad;
	}

	public function getCant(){
		return $this->cant;
	}

	//Validar

	public function validar(){
		//Comprueba que tenga un maximo de $this->cant caracteres
		if(strlen($this->dato) <= $this->cant){
			return true;
		}

		return false;
	}
}


class ValMail extends Val{
	//Validar

	public function validar(){
		//comprueba que el dato ingresado es un mail

		$mail = filter_var($this->dato, FILTER_VALIDATE_EMAIL);

		if($mail !== false){
			return true;
		}

		return false;
	}
}

class ValFecha extends Val{
	private $formato = false;

	public function __construct($unDato, $unMensaje, $unFormato = "d/m/Y"){
		$this->dato = $unDato;
		$this->mensaje = $unMensaje;
		$this->formato = $unFormato;
	}

	public function setFormato($unFormato){
		$this->mensaje = $unFormato;
	}

	public function getFormato(){
		return $this->formato;
	}

	//Validar

	public function validar(){
		//Comprueba que el dato ingresado sea una fecha
		$fecha = preg_split("/\//",$this->dato);
		return checkdate($fecha[1]*1,$fecha[0]*1,$fecha[2]*1);
	}
}

class ValNumero extends Val{

	public function validar(){
		//comprueba que el dato ingresado es un numero

		if(is_numeric($this->dato)){
			return true;
		}

		return false;
	}
}

class ValInteger extends Val{

	public function validar(){
		//comprueba que el dato ingresado es un numero

		if(!is_numeric($this->dato)){
			return false;
		}

		$this->dato = $this->dato*1;

		if(is_int($this->dato)){
			return true;
		}

		return false;
	}
}

class Validador{
	//Validacion que debe soportar:
	//Requerido
	//Cantidad minima y maxima de caracteres
	//Tipo fecha
	//Tipo mail
	//Tipo numero
	//Tipo numero int

	//Recordatorio: dato puede ser un array donde se verifica un conjunto de datos sobre la misma validacion.
	protected $validadores = Array();
	protected $errores = Array();
	protected $esValido;

	public function __construct(){
	}

	//Setters

	public function setValidadores($unosValidadores){
		$this->validadores = $unosValidadores;
	}

	public function setErrores($unosErrores){
		$this->errores = $unosErrores;
	}

	public function setEsValido($unEsValido){
		$this->esValido = $unEsValido;
	}

	public function setDatosValidador($unDato){
		foreach($this->validadores as $i => $val){
			$val->setDato($unDato);
		}
	}

	//Getters

	public function getValidadores(){
		return $this->validadores;
	}

	public function getErrores(){
		return $this->errores;
	}

	public function getUltimoError(){
		//Devuelve el ultimo error si hay, sino devuelve false
		if(count($this->errores)>0){
			return $this->errores[count($this->errores)-1];
		}
		return false;
	}

	public function getEsValido(){
		return $this->esValido;
	}

	//Agregar validadores

	public function addRequerido($unDato, $unMensaje){

		$val = new ValRequerido($unDato,$unMensaje);
		$this->validadores[] = $val;
	}

	public function addMaxCaracteres($unDato, $unMensaje,$unaCantidad){

		$val = new ValMaxCaracteres($unDato,$unMensaje, $unaCantidad);
		$this->validadores[] = $val;
	}

	public function addMinCaracteres($unDato, $unMensaje,$unaCantidad){

		$val = new ValMinCaracteres($unDato,$unMensaje, $unaCantidad);
		$this->validadores[] = $val;
	}

	public function addFecha($unDato, $unMensaje,$unFormato = "d/m/Y"){

		$val = new ValFecha($unDato,$unMensaje, $unFormato);
		$this->validadores[] = $val;
	}

	public function addMail($unDato, $unMensaje){

		$val = new ValMail($unDato,$unMensaje);
		$this->validadores[] = $val;
	}

	public function addNumero($unDato, $unMensaje){

		$val = new ValNumero($unDato,$unMensaje);
		$this->validadores[] = $val;
	}

	public function addInteger($unDato, $unMensaje){

		$val = new ValInteger($unDato,$unMensaje);
		$this->validadores[] = $val;
	}

	//Validar

	public function validar($unDato = false){
		//Hace todas las validaciones de $this->validadores.
		//Si todas las validaciones son correctas devuelve true, devuelve false de lo contrario.

		$cant = count($this->validadores);
		$esCorrecto = true;
		for($i = 0; $i<$cant; $i++){
			$valido = $this->validadores[$i]->validar();
			if($valido===false){
				$esCorrecto = false;
				$this->errores[] = $this->validadores[$i]->getMensaje();
			}
		}

		$this->esValido = $esCorrecto;
		return $esCorrecto;
	}

}

class Restricciones extends Validador {
	private $idParseURI;

	public function __construct($idParseURI){
		$this->idParseURI = $idParseURI;
	}

	public function getIdParseURI(){
		return $this->idParseURI;
	}

	public function setIdParseURI($idParseURI){
		$this->idParseURI = $idParseURI;
	}

	public function validar($unDato= false){
		//Hace todas las validaciones de $this->validadores.
		//Si todas las validaciones son correctas devuelve true, devuelve false de lo contrario.

		$cant = count($this->validadores);
		$esCorrecto = true;
		for($i = 0; $i<$cant; $i++){
			$valido = $this->validadores[$i]->setDato($unDato);
			$valido = $this->validadores[$i]->validar();
			if($valido===false){
				$esCorrecto = false;
				$this->errores[] = $this->validadores[$i]->getMensaje();
			}
		}

		$this->esValido = $esCorrecto;
		return $esCorrecto;
	}
}

?>
