<?php namespace App;

use \App\Models\Share\Route as Route;
use \App\Models\Share\Router as Router;



//Middlewares son intermediarios que permiten encolar procesos y despacharlos, el proceso que se ejecuta llama al siguiente hasta terminar.
// Ejemplo en:http://ujjwalojha.com.np/middleware-php-presentation/
// Puedo tener un controlador general de los middlewares, que cargue unos middlewares generales, pero que a su vez se puedan agregar nuevas tareas desde otras partes del código.
// Los middlewares van a ser nombrados y tener estados de sin ejecutar, ejecutando o ejecutado, etc, y estados de errores
// Ej:
// 1 - Iniciar app
// 2 - Cargar la configuración. OK
// 2 - Crear conección a la base de datos. Ver Doctrine
// 3 - Tomar request
// 4 - Seleccionar ruta(
//  4.1 - Validar usuario
//  4.2 - Comprobar rol del usuario
//)

class App{

  private $router;

  public function __construct(){
    // Crear la cola de procesos.
    $request = new \App\Models\Share\Http\Request();

    $this->run($request);

  }

  public function run(\App\Models\Share\Http\Request $request){

    $life = new \App\Life\Life();

    $life->addProcess(new \App\Life\Processes\RoutesProcess());
    $life->addProcess(new \App\Life\Processes\AuthProcess());
    $life->addProcess(new \App\Life\Processes\ValidationsProcess());
    $life->addProcess(new \App\Life\Processes\ConfigProcess());

    //Tiene que haber un proceso encargado de configurar correctamente la respuesta. O dentro de Send.

    $response = $life->run($request);
    $response->setStatus("200");

    $response->send();
  }

}

?>
