<?php

  require_once "../config/config.php";
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: *');
  header('Access-Control-Allow-Methods: *');


  spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
  });

  // initialize the router
  new Router();
