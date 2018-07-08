<?php
  //Headers:
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Quotes.php';

  //Instantiate database:
  $db = new Database();
  $quote = new Quotes($db->connect());

  //Get raw posted data:
  $data = json_decode(file_get_contents("php://input"));

  $quote->datetime = $data->datetime;
  $quote->client = $data->client;
  $quote->total = $data->total;
  $quote->quote = $data->quote;

  $items_array = array();
  $items = $data->quoteItems;

  foreach ($items as $item) {
    $temp = array(
      'id' => $item->id,
      'units' => $item->units,
      'total' => $item->total
    );

    array_push($items_array, $temp);
  }

  if($quote->create($items_array)) {
    echo json_encode(array(
      'message' => 'Quote created'
    ));
  } else {
    echo json_encode(array(
      'message' => 'Error in quote creation'
    ));
  }
?>
