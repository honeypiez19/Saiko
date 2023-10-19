<?php include 'connect.php';
header('Content-Type: application/json');

// get mount and find date of mount
if (isset($_POST['function']) && $_POST['function'] == 'dateMount') {
  $m = $_POST["mount"];
  $Y = $_POST["year"];
  $d = cal_days_in_month(CAL_GREGORIAN, $m, $Y);
  echo $d; // send total date to ajax
}

// check date and send PONo
if (isset($_POST['function']) && $_POST['function'] == 'dateIn') {
  $id = $_POST["id"];
  $sql = "select * from Stockin order by Product_code";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $result) {
    $d = strtotime($result['Date_add']);
    $dateAdd = date("Y-m-d", $d); // set format of date
    if ($id == $dateAdd) {  // compare date from ajax and date of product
      $code[] = $result['Product_code'];
    }
  }
  echo json_encode($code);
}

// get Product_code from ajax function In_code and send value of row
if (isset($_POST['function']) && $_POST['function'] == 'In_code') {
  $id = $_POST["id"];
  $date = $_POST["datecheck"];
  $sql = "select * from Stockin";
  $query = mysqli_query($conn, $sql);

  foreach ($query as $result) {
    $code = $result['Product_code'];
    $d = strtotime($result['Date_add']);
    $dateReq = date("Y-m-d", $d); // set format of date
    if ($date == $dateReq && $id == $code) {  // compare date and product_code

      // two-dimensional array for send to ajax and can loop for encode object
      $value = array(
        array(
          'PONo' => $result['PONo'],
          'code' => $result['Product_code'],
          'name' => $result['Product_name'],
          'qty' => $result['Qty'],
          'unit' => $result['Unit'],
          'unit_price' => $result['Unit_price'],
          'datetime' => $result['Date_add'],
        )
      );
    }
  }
  echo json_encode($value);
}

// check date and send Product_code
if (isset($_POST['function']) && $_POST['function'] == 'dateOut') {
  $id = $_POST["id"];
  $sql = "select * from Stockout";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $result) {
    $d = strtotime($result['Date_out']);
    $dateAdd = date("Y-m-d", $d);
    if ($id == $dateAdd) {
      $code[] = $result['Product_code'];
    }
  }
  echo json_encode($code);
}

// get Product_code from ajax function In_code and send value of row
if (isset($_POST['function']) && $_POST['function'] == 'Out_code') {
  $id = $_POST["id"];
  $date = $_POST["datecheck"];
  $sql = "select * from Stockout";
  $query = mysqli_query($conn, $sql);

  foreach ($query as $result) {
    $code = $result['Product_code'];
    $d = strtotime($result['Date_out']);
    $dateReq = date("Y-m-d", $d); // set format of date
    if ($date == $dateReq && $id == $code) {  // compare date and product_code

      // two-dimensional array for send to ajax and can loop for encode object
      $value = array(
        array(
          'code' => $result['Product_code'],
          'name' => $result['Product_name'],
          'qty' => $result['Qty'],
          'unit' => $result['Unit'],
          'unit_price' => $result['Unit_price'],
          'datetime' => $result['Date_add'],
        )
      );
    }
  }
  echo json_encode($value);
}

// check date and send Product_code
if (isset($_POST['function']) && $_POST['function'] == 'dateAdd') {
  $id = $_POST["id"];
  $sql = "select * from AddNewStock order by Product_code";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $result) {
    $d = strtotime($result['Date_add']);
    $dateAdd = date("Y-m-d", $d);
    if ($id == $dateAdd) {
      $code[] = $result['Product_code'];
    }
  }
  echo json_encode($code);
}

// get Product_code from ajax function add_code and send value of row
if (isset($_POST['function']) && $_POST['function'] == 'add_code') {
  $id = $_POST["id"];
  $date = $_POST["datecheck"];
  $sql = "select * from AddNewStock";
  $query = mysqli_query($conn, $sql);

  foreach ($query as $result) {
    $code = $result['Product_code'];
    $d = strtotime($result['Date_add']);
    $dateReq = date("Y-m-d", $d); // set format of date
    if ($date == $dateReq && $id == $code) {  // compare date and product_code

      $pcode = $result['Product_code'];
      $pname = $result['Product_name'];
      // two-dimensional array for send to ajax and can loop for encode object
      $value = array(
        array(
          'code' => $pcode,
          'name' => $pname,
          'qty' => $result['Qty'],
          'unit' => $result['Unit'],
          'unit_price' => $result['Unit_price'],
          'datetime' => $result['Date_add'],
        )
      );
    }
  }
  echo json_encode($value);
}
