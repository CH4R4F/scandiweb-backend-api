<?php

  class RequestHandler {
    private $productModal;

    public function __construct(Database $db) {
      $this->productModal = new ProductModal($db);
    }

    public function requestListener(string $method, ?string $id) {
      if($id) {
        // in this case I only need to handle the delete request, but this can be helpful in case wanna handle other requests in the future (like GET and PATCH etc ..)
        $this->handleProductRequest($method, $id);
      } else {
        // this will handle GET, POST, and DELETE requests to display and save data 
        $this->handleRessourceRequest($method);
      }
    }

    // this function can bring data for a single resource,
    // but in case of project I'll use it just to check if sku is already in use or not
    private function handleProductRequest($method, $id) {
      if($method === "GET") {
        $res = $this->productModal->getProduct($id);
        echo json_encode($res);
      } else if($method === "POST" && $id === "delete") {
          $data = json_decode(file_get_contents('php://input'));
          $error = [];
          foreach($data as $id) {
            if(!$this->productModal->deleteProduct($id)) {
              $error[] = [
                'status' => 502,
                'message' => 'Something went wrong while deleting data from the database'
              ];
            }
          }
          if(count($error) > 0) {
            echo json_encode($error);
          } else {
            echo json_encode([
              'status' => 200,
              'message' => 'Product deleted successfully'
            ]);
          }
      }
    }


      // I'm not handeling server errors here
      public function handleRessourceRequest($method) {
        if($method == "GET") {
          $this->productModal->getAllProducts();
        } else if($method == "POST") {
          $data = json_decode(file_get_contents('php://input'));
          $this->productModal->insertProduct($data);
        } 
        // ============== 000webhost doesn't allow DELETE requests on free plan :( =================
        // else if($method == "DELETE") {
        //   $data = json_decode(file_get_contents('php://input'));
        //   $error = [];
        //   foreach($data as $id) {
        //     if(!$this->productModal->deleteProduct($id)) {
        //       $error[] = [
        //         'status' => 502,
        //         'message' => 'Something went wrong while deleting data from the database'
        //       ];
        //     }
        //   }
        //   if(count($error) > 0) {
        //     echo json_encode($error);
        //   } else {
        //     echo json_encode([
        //       'status' => 200,
        //       'message' => 'Product deleted successfully'
        //     ]);
        //   }
        // }
      }
  }