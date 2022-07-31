<?php

  class ProductModal {
    private $conn;
    public function __construct(Database $db) {
      $this->conn = $db->connect();
    }

    public function getAllProducts() {
      $query = "SELECT * FROM products ORDER BY product_id DESC";
      try {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      } catch(PDOException $e) {
        echo json_encode([
          'status' => 502,
          'error' => $e->getMessage(),
          'message' => 'Something went wrong while fetching data from the database',
          'file' => $e->getFile(),
          'line' => $e->getLine()
        ]);
      }
    }

    public function getProduct(string $sku) {
      $query = "SELECT * FROM products WHERE product_sku = :sku";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":sku", $sku);
      
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertProduct($data) {
      $query = "INSERT INTO products (
          product_sku, product_name, product_type, product_price, product_attribute
        ) VALUES (
          :p_sku, :p_name, :p_type, :p_price, :p_attr
        )";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":p_sku", $data->sku);
      $stmt->bindParam(":p_name", $data->name);
      $stmt->bindParam(":p_type", $data->type);
      $stmt->bindParam(":p_price", $data->price);
      $stmt->bindParam(":p_attr", $data->attributes);
      
      if($stmt->execute()) {
        echo json_encode([
          'status' => 200,
          'message' => 'Product inserted successfully'
        ]);
      } else {
        echo json_encode([
          'status' => 502,
          'error' => $stmt->errorInfo(),
          'message' => 'Something went wrong while inserting data into the database'
        ]);
      }
    }

    public function deleteProduct($id) {
      $query = "DELETE FROM products WHERE product_id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":id", $id);
      
      return $stmt->execute();
    }
  }