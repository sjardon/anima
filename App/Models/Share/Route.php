<?php namespace App\Models\Share;

use \App\Models\Share\Http\Request as Request;
use \App\Models\Share\Route\Parameter as Parameter;

class Route{

	protected $uri;
  protected $parameters = false;
  protected $callback;
  protected $validations;

	public function __construct($uri,$callback){
      $this->uri = $this->getRouteUri($uri);
      $this->callback = $this->getCalbackAction($callback);
      $this->parameters = $this->getUriParameters();
	}

	public function getUri(){
		return $this->uri;
	}

	public function getParameters(){
		return $this->parameters;
	}

	public function getParametersAsArray(){
		$parameters = Array();
		if(is_array($this->parameters)){
			foreach($this->parameters as $p){
				$parameters[$p->getName()] = $p->getValue();
			}
		}

		return $parameters;
	}

	public function getCallback(){
		return $this->callback;
	}

	public function getValidations(){
		return $this->validations;
	}

	public function setUri($uri){
		$this->uri = $uri;
	}

	public function setParameters($parameters){
		$this->parameters = $parameters;
	}

	public function setCallback($callback){
		$this->callback = $callback;
	}

	public function setValidations($validations){
		$this->validations = $validations;
	}

	protected function getRouteUri($uri){

		$uri = explode("/",filter_var(rtrim($uri,"/"),FILTER_SANITIZE_URL));

		$uri = array_values(array_filter($uri,function($val){
			return ($val != "");
		}));

		return $uri;
	}

	protected function getUriParameters(){
		$parameters = Array();
		if(is_array($this->uri)){

			foreach($this->uri as $u){

				$param = $this->isParameter($u);


				if($param !== false){
					$parameters[$param] = new Parameter($param);

				}
			}
		}
		return $parameters;
	}

	public function isParameter($parameter){
		return ( preg_match('/^\{(.*?)\}$/',$parameter,$p) == 1 ? $p[1] : false );
	}

	protected function setParametersFromRequest(Request $request){
		// Obtener la posición del parametro.
		// Obtener el valor que hay en ese parametro.

		$arrayRequestParameters = $request->getUri();
		$arrayRouteParameters = $this->uri;

		if(count($arrayRouteParameters) == count($arrayRequestParameters)){


			foreach($arrayRouteParameters as $i => $p){


				$param = $this->isParameter($p);

				if($param !== false){

					if(isset($this->parameters[$param])){
						$this->parameters[$param]->setValue($arrayRequestParameters[$i]);
					}
				}
			}
		}
	}

	public function addValidations($validations){
		if(is_array($validations)){
			foreach($validations as $key => $val){
				
			}

		}
	}

	protected function getCalbackAction($callback){

		if(is_callable($callback)){

			$callbackAction = $callback;

		}elseif(is_string($callback)){

			$callbackAction = preg_split('/@/',$callback);

			if(isset($callbackAction[0])){
				$callbackAction[0] = "\App\Controllers\\".$callbackAction[0];
			}

		}

		return $callbackAction;
	}

	public function getCallbackFromRequest(Request $request){

		$routeRun = false;

		if(is_array($this->callback)){
			//Es un controlador

			if(count($this->callback)==2){
				//Se especifica que metodo del controlador se va a usar
				$routeRun = new Route\RouteRunMethod($this,$request);
			}else{
				//Se decide el metodo por el metodo del request
				switch ($request->getMethod()) {
					case 'GET':
					$routeRun = new Route\RouteRunGet($this,$request);
					break;
					case 'POST':
					$routeRun = new Route\RouteRunPost($this,$request);
					break;
					case 'PUT':
					$routeRun = new Route\RouteRunPut($this,$request);
					break;
					case 'DELETE':
					$routeRun = new Route\RouteRunDelete($this,$request);
					break;
				}
			}
		}elseif(is_callable($this->callback)){
			//Si es una funcion
			$routeRun = new Route\RouteRunFunction($this,$request);

		}

		return $routeRun;

	}

  public function run(Request $request){

		$this->setParametersFromRequest($request);
		$routeRun = $this->getCallbackFromRequest($request);

		if($routeRun){
			$routeRun->run();
		}
  }

}

?>
