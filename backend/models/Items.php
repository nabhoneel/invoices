<?php

class Items {
  private $conn;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function read_all() {
    $query = 'SELECT
        i.`item`, o.`id`, o.`name`, o.`cost`
      FROM
        `item-option` o
        LEFT JOIN `item` i
        ON i.`id` = o.`item-id`';

    $stmt = $this->conn->prepare($query);
    $state = $stmt->execute();

    $output = array();
    $output['data'] = array();

    if($state != false) {
      $output['message'] = 'true';
      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()) {
        $arr = array(
          'id' => $row['id'],
          'item' => $row['item'],
          'name' => $row['name'],
          'cost' => $row['cost']
        );

        array_push($output['data'], $arr);
      }
    } else {
      $output['message'] = 'false';
      array_push($output['data'], '');
    }

    return $output;
  }

  public function read_crew() {
    $query = 'SELECT
        i.`item`, o.`id`, o.`name`, o.`cost`
      FROM
        `item-option` o
        LEFT JOIN `item` i
        ON i.`id` = o.`item-id`
      WHERE i.`type` = "Crew"';

    $stmt = $this->conn->prepare($query);
    $state = $stmt->execute();

    $output = array();
    $output['data'] = array();

    if($state != false) {
      $output['message'] = 'true';
      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()) {
        $arr = array(
          'id' => $row['id'],
          'item' => $row['item'],
          'name' => $row['name'],
          'cost' => $row['cost']
        );

        array_push($output['data'], $arr);
      }
    } else {
      $output['message'] = 'false';
      array_push($output['data'], '');
    }

    return $output;
  }

  public function read_equipments() {
    $query = 'SELECT
        i.`item`, o.`id`, o.`name`, o.`cost`
      FROM
        `item-option` o
        LEFT JOIN `item` i
        ON i.`id` = o.`item-id`
      WHERE i.`type` = "Equipment"';

    $stmt = $this->conn->prepare($query);
    $state = $stmt->execute();

    $output = array();
    $output['data'] = array();

    if($state != false) {
      $output['message'] = 'true';
      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()) {
        $arr = array(
          'id' => $row['id'],
          'item' => $row['item'],
          'name' => $row['name'],
          'cost' => $row['cost']
        );

        array_push($output['data'], $arr);
      }
    } else {
      $output['message'] = 'false';
      array_push($output['data'], '');
    }

    return $output;
  }

  public function read_editing($edit_type) {
    $query = 'SELECT
        i.`item`, o.`id`, o.`name`, o.`cost`
      FROM
        `item-option` o
        LEFT JOIN `item` i
        ON i.`id` = o.`item-id`
      WHERE
        i.`type` = "editing" AND
        i.`item` LIKE ?';

    $stmt = $this->conn->prepare($query);
    $edit_type = "%" . $edit_type . "%";
    $stmt->bind_param("s", $edit_type);
    $state = $stmt->execute();

    $output = array();
    $output['data'] = array();

    if($state != false) {
      $output['message'] = 'true';
      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()) {
        $arr = array(
          'id' => $row['id'],
          'item' => $row['item'],
          'name' => $row['name'],
          'cost' => $row['cost']
        );

        array_push($output['data'], $arr);
      }
    } else {
      $output['message'] = 'false';
      array_push($output['data'], '');
    }

    return $output;
  }
}

?>
