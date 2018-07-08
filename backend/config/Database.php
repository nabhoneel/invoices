<?php

class Database {
  private $conn;
  private $db_name = 'invoices';
  private $host = 'localhost';
  private $username = 'root';
  private $password = '';

  public function connect() {
    $this->conn = null;
    try {
      $this->conn = new mysqli(
        $this->host,
        $this->username,
        $this->password,
        $this->db_name
      );
    } catch(Exception $e) {
      echo 'Connection error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}

?>
