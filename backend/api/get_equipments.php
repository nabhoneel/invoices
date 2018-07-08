<?php

//Headers:
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../config/Database.php');
include_once('../models/Items.php');
$db = new Database();
$items = new Items($db->connect());

$output = $items->read_equipments();

if($output['message'] == 'true') {
  echo json_encode($output['data']);
} else {
  echo json_encode(
    array('message' => 'No items found')
  );
}

?>
