<?php namespace App\Models\Share;

//El router se va a encargar de recoger todas las rutas y verificar una por una las coincidencias con

class Router{

	protected $routes;
	protected $routeAct;

	public function __construct($routes){
		$this->routes = $routes;
		$this->routeAct = new \App\Models\Share\Route();
	}

	public function matchRoute(){
		$uri = $this->parseUrl();
		$noCtrl = false;

		if($this->checkControlador($uri)){
			unset($uri[0]);
			$uri = array_values($uri);
		}else{
			$noCtrl = true;
		}

		require_once("App/Controllers/".$this->routeAct->getControladorFile().".php");

		$noAccion = false;

		if($this->checkAccion($uri)){
			unset($uri[0]);
			$uri = array_values($uri);
		}else{
			$noAccion = true;
		}

		$this->setParametros($uri);

		$routeValida = $this->compareRoutes();


		if($routeValida){
			
			$routeValida->setParametros($this->routeAct->getParametros());
		}else{

			$routeValida = new \App\Models\Share\Route("ErrorController","e404");
		}

		return $routeValida;

	}

	public function checkControlador($uri){
		if(isset($uri[0])){
			if(file_exists("App/Controllers/".$uri[0]."Controller.php")){
				$this->routeAct->setControlador($uri[0]."Controller");
				return true;
			}
		}

		return false;
	}

	public function checkAccion($uri){
		if(isset($uri[0])){
			//var_dump(method_exists($this->routeAct->getControlador(),$uri[0]));

			$ctrl = $this->routeAct->getControladorClass();

			$ctrl = new $ctrl;

			if(method_exists($ctrl,$uri[0])){
				$this->routeAct->setAccion($uri[0]);
				return true;
			}
		}

		return false;
	}

	public function setParametros($uri){
		$params = array();

		foreach($uri as $i => $param){
			$params[] = new Parametro($param);
		}

		$this->routeAct->setParametros($params);
	}

	public function compareRoutes(){
		$is = false;
		foreach($this->routes as $i=>$route){
			if($route->checkRoute($this->routeAct)){
				return $route;
			}
		}

		return false;
	}

	public function parseUrl(){
		//rtrim: Elimino / del comienzo y el final de la uri
		//fliter_var: Elimino los caracteres menos digitos, letras y otros (ver doc php)
		//array_value y filter: Termino de sacar los caracteres vacios
		$uri = $_SERVER['REQUEST_URI'];

		$uri = explode("/",filter_var(rtrim($uri,"/"),FILTER_SANITIZE_URL));

		$uri = array_values(array_filter($uri,function($val){
			return ($val != "" AND $val != "apk" AND $val != "index.php" AND $val != "Faecc" AND $val != "route");
		}));
		return $uri;
	}

}

?>
