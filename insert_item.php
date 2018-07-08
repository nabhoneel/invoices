<?php

include_once('backend/config/Database.php');
$db = new Database();
$conn = $db->connect();

$data =
'{
  "options": [
    {
      "name": "1",
      "cost": "4000"
    },
    {
      "name": "2",
      "cost": "6000"
    },
    {
      "name": "3",
      "cost": "8000"
    },
    {
      "name": "4",
      "cost": "10000"
    },
    {
      "name": "5",
      "cost": "15000"
    },
    {
      "name": "6",
      "cost": "20000"
    }
  ]
}';

// echo $data;

$data_array = (array)json_decode($data);

$query = "INSERT INTO `item-option` (`id`, `item-id`, `name`, `cost`) VALUES (NULL, '12', ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $name, $cost);

foreach($data_array['options'] as $key => $option) {
  $name = $option->name;
  $cost = intval($option->cost);
  $stmt->execute();
  if(!$stmt) echo $stmt->error;
}

?>
