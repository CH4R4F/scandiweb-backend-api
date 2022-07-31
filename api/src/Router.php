<?php
  // a simple router that will route the request to the correct handler
  class Router {

    public function __construct() {
      // the uri is like this: /api/resource/id
      $url = $this->parseUrl();
      // $url is like this ['api', 'resource', 'id'] now
      $ressource = $url[1] ?? null;
      $id = $url[2] ?? null;
      // in this example, we have only one endpoint which handle products data, but this can be scaled easily in the future.
      if($ressource !== 'products') {
        http_response_code(404);
        die();
      }
      $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $handler = new RequestHandler($db);

      $handler->requestListener($_SERVER['REQUEST_METHOD'], $id);

    }


    private function parseUrl() {
      $url = $_SERVER['REQUEST_URI'];
      $url = trim($url, '/');
      $url = explode('/', $url);
      return $url;
    }
  }