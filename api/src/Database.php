<?php
  class Database {
    public function __construct(private $host, private $user, private $password, private $database) {
      $this->connect();
    }

    public function connect() {

      try{
        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
      } catch(PDOException $e) {
        // error details
        echo json_encode([
          'status' => 500,
          'error' => $e->getMessage(),
          'message' => 'Something went wrong while connecting to the database',
          'file' => $e->getFile(),
          'line' => $e->getLine()
        ]);
        die();
      }

      
      return $this->pdo;
    }
  }