<?php namespace \App\Models\Share;

class Respuesta extends \App\Models\AbstractModel{

	//Debe de analizar las respuestas y devolver lo que corresponde
	// Procesando, Completo y correcto, Completo y con errores, Error del cliente, Error del servidor

	protected $tipo;
	protected $resp;

	public function __construct($tipo,$resp){
		$this->tipo = $tipo;
		$this->resp = $resp;
	}

	public function enviar(){
		$resp = $this->toJson();
		// echo json_encode($resp);
	}

}

?>
