<?php include 'connect.php';
header('Content-Type: application/json');

// 
if (isset($_POST['function']) && $_POST['function'] == 'code') {
  $id = $_POST["id"];
  $sql = "SELECT * FROM User WHERE Usercode = '$id' ";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  $value = array(
    'name' => $result['Name'],
    'lname' => $result['Username'],
  );
  echo json_encode($value);
}

// get value from function search and send Product_code and name
if (isset($_POST['function']) && $_POST['function'] == 'search') {
  $search = $_POST["id"];
  $sql = "SELECT * FROM Stock WHERE Product_code = '$search' ";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  if (mysqli_num_rows($query) == 0) {
    $value[] = array(
      'status' => 0,
    );
    echo json_encode($value);
  } else {
    $value = array(
      'status' => 1,
      'ProductCode' => $result['Product_code'],
      'ProductName' => $result['Product_name'],
      'max_qty' => $result['Qty'],
    );
    echo json_encode($value);
  }
}

// get value from function submit and insert to table Request
if (isset($_POST['function']) && $_POST['function'] == 'submit') {
  $dateReq = $_POST['dateReq'];
  $name_req = $_POST['Name_req'];
  $arrProduct = $_POST['reqDetails'];

  foreach ($arrProduct as $row) {
    $PCode = $row['PCode'];
    $PName = $row['Pname'];
    $PQty = $row['Pqty'];
    $PUnit = $row['Punit'];
    $ProdNo = $row['Pprod'];
    $Part = $row['Ppart'];

    $sql = "INSERT INTO Request (ID_req,Name_req,Product_code,Product_name,Qty,Unit,Prod_no,Part)
    VALUE  ('$dateReq','$name_req','$PCode', '$PName', '$PQty', '$PUnit', '$ProdNo', '$Part')";
    $query = mysqli_query($conn, $sql);
  }
  if ($query) {
    $response = array(
      'status' => 1,
    );
    echo json_encode($response);
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Error' . "   " . $conn->error,
    );
    echo json_encode($response);
  }

  mysqli_close($conn);
}
