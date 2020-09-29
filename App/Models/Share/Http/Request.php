<?php

  namespace App\Models\Share\Http;

    //CONTENT_TYPE: Tipo de contenido, application/json, application/x-www-form-urlencoded;
    //REQUEST_METHOD: GET, POST, PUT, DELETE;
    //REQUEST_URI: Resource de la petición

  class Request{

    protected $contentType;
    protected $method;
    protected $parameters;
    protected $uri;
    protected $token;



    public function __construct(){

      $this->contentType = $this->getRequestContentType();

      $this->method = $this->getRequestMethod();

      $this->parameters = $this->getRequestParameters();

      $this->uri = $this->getRequestUri();

      $this->token = $this->getRequestToken();


    }

    public function setContentType($contentType){
      $this->contentType = $contentType;
    }

    public function setMethod($method){
      $this->method = $method;
    }

    public function setParameters($parameters){
      $this->parameters = $parameters;
    }

    public function setUri($uri){
      $this->uri = $uri;
    }

    public function setToken($token){
      $this->token = $token;
    }

    public function getContentType(){
      return $this->contentType;
    }

    public function getMethod(){
      return $this->method;
    }

    public function getParameters(){
      return $this->parameters;
    }

    public function getUri(){
      return $this->uri;
    }

    public function getToken(){
      return $this->token;
    }

    protected function getRequestContentType(){
       if(empty( $_SERVER["CONTENT_TYPE"])){
         return false;
       }

       return  $_SERVER["CONTENT_TYPE"];
    }

    protected function getRequestMethod(){

      if(empty($_SERVER["REQUEST_METHOD"])) {
        return false;
      }else{
        $requestMethod = $_SERVER["REQUEST_METHOD"];
      }

      switch ($requestMethod) {
        case 'GET':
        case 'POST':
        case 'PUT':
        case 'DELETE':
          return $requestMethod;
        break;
        default:
          return false;
        break;
      }
    }

    protected function getRequestParameters(){

      switch ($this->method) {
        case 'GET':
          return $_GET;
        case 'POST':
        case 'PUT':
          return json_decode(file_get_contents("php://input"),true);
        break;
        default:
          return false;
        break;
      }
    }

    protected function getRequestUri(){

      $uri = $_SERVER['REQUEST_URI'];

      $uri = explode("/",filter_var(rtrim($uri,"/"),FILTER_SANITIZE_URL));

      $uri = array_values(array_filter($uri,function($val){
        return ($val != "" AND $val != "anima" AND $val != 'index.php');
      }));

      return $uri;
    }

    protected function getRequestToken(){
      if(empty($_SERVER["HTTP_TOKEN"])){
        return false;
      }

      return $_SERVER["HTTP_TOKEN"];
    }

  }


?>
