<?php include 'connect.php';
header('Content-Type: application/json');

// get mount and find date of mount
if (isset($_POST['function']) && $_POST['function'] == 'datemonth') {
  $m = $_POST["month"];
  $Y = $_POST["year"];
  $d = cal_days_in_month(CAL_GREGORIAN, $m, $Y);
  echo $d; // send total date to ajax
}

// check date and send Reqno
if (isset($_POST['function']) && $_POST['function'] == 'dateReq') {
  $id = $_POST["id"]; // day
  $sql = "select * from Request order by Date_req";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $result) {
    $d = strtotime($result['Date_req']);
    $dateReq = date("Y-m-d", $d); // set format of date
    if ($id == $dateReq) {  // compare date from ajax and date of product
      $value[] = 
        array(
          'day' => $id,
          'code' => $result['Product_code'],
          'name' => $result['Product_name'],
          'qty' => $result['Qty'],
          'unit' => $result['Unit'],
          'prod' => $result['Prod_no'],
          'part' => $result['Part'],
          'datetime' => $result['Date_req'],
          'name_req' => $result['Name_req'],
      );
    }
  }
  echo json_encode($value);
}

// get Product_code from ajax function In_code and send value of row
if (isset($_POST['function']) && $_POST['function'] == 'Req_code') {
  $id = $_POST["id"];
  $date = $_POST["datecheck"];
  $sql = "select * from Request";
  $query = mysqli_query($conn, $sql);

  foreach ($query as $result) {
    $code = $result['Product_code'];
    $d = strtotime($result['Date_req']);
    $dateReq = date("Y-m-d", $d); // set format of date
    if ($date == $dateReq && $id == $code) {  // compare date and product_code
      
      // two-dimensional array for send to ajax and can loop for encode object
      $value = array(
        array(
          'code' => $result['Product_code'],
          'name' => $result['Product_name'],
          'qty' => $result['Qty'],
          'unit' => $result['Unit'],
          'prod' => $result['Prod_no'],
          'part' => $result['Part'],
          'datetime' => $result['Date_req'],
          'name_req' => $result['Name_req'],
        )
      );
    }
  }
  echo json_encode($value);
}
