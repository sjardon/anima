<?php
  ini_set("display_errors",1);
  require_once "App/Config/Autoload.php";

  $autoload = new \App\Config\Autoload();
  $autoload->load();

  $app = new \App\App();

?>
