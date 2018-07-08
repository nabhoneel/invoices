<?php

class Quotes {
  private $conn;

  public $datetime;
  public $client;
  public $total;
  public $quote;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function create($items) {
    $query = 'INSERT INTO `quote`
              (`id`, `datetime`, `client`, `total`, `quote`)
              VALUES (NULL, ?, ?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
      'ssii',
      $this->datetime,
      $this->client,
      $this->total,
      $this->quote
    );
    if(!$stmt->execute()) return false;

    $ID = $stmt->insert_id;

    $query = 'INSERT INTO `quote-items`
              (`quote-id`, `option-id`, `unit`, `total`)
              VALUES (?, ?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
      'iiii',
      $quoteID,
      $optionID,
      $unit,
      $total
    );

    foreach ($items as $item) {
      $quoteID = $ID;
      $optionID = $item['id'];
      $unit = $item['units'];
      $total = $item['total'];

      if(!$stmt->execute()) return false;
    }

    return true;
  }
}

?>
