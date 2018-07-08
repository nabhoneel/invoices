<?php

//Headers:
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../config/Database.php');
include_once('../models/Items.php');
$db = new Database();
$items = new Items($db->connect());

$edit_type = isset($_GET['edit']) ? $_GET['edit'] : '';

$output = $items->read_editing($edit_type);

if($output['message'] == 'true') {
  echo json_encode($output['data']);
} else {
  echo json_encode(
    array('message' => 'No items found')
  );
}

?>
