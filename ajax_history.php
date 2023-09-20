<?php include 'connect.php';
header('Content-Type: application/json');

// check date and send Product_code
if (isset($_POST['function']) && $_POST['function'] == 'date') {
  $id = $_POST["id"];
  $date = date('Y-m-d');
  $sql = "select * from AddNewStock";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $result) {
    $d = strtotime($result['Date_add']);
    $dateAdd = date("Y-m-d", $d);
    if ($date == $dateAdd) {
      $code[] = $result['Product_code'];
      print_r($code);
    }
  }
}

if (isset($_POST['function']) && $_POST['function'] == 'code') {
  $id = $_POST["id"];
  $sql = "select * from AddNewStock where Product_code='$id'";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  $value = array(
    'code' => $result['Product_code'],
    'name' => $result['Product_name'],
  );
  echo json_encode($value);
}
