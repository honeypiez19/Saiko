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
    $value = array(
        'ProductCode' => $result['Product_code'],
        'ProductName' => $result['Product_name'],
        'max_qty' => $result['Qty'],
      );
      echo json_encode($value);
}

// get value from function submit and insert to table Request
if (isset($_POST['function']) && $_POST['function'] == 'submit') {
  $dateReq = $_POST['dateReq'];
  $name_req = $_POST['Name_req'];
  $PCode = $_POST['P_Code'];
  $PName = $_POST['P_Name'];
  $PQty = $_POST['P_Qty'];
  $PUnit = $_POST['P_Unit'];
  $ProdNo = $_POST['P_ProdNo'];
  $Part = $_POST['P_Part'];
  $sql = "INSERT INTO Request (ID_req,Name_req,Product_code,Product_name,Qty,Unit,Prod_no,Part)
          VALUE  ('$dateReq','$name_req','$PCode', '$PName', '$PQty', '$PUnit', '$ProdNo', '$Part')";
  if (mysqli_query($conn, $sql)) {
    $response = array(
      'status' => 1,
    );
    echo json_encode($response);
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Error'."   ". "   " . $conn->error,
    );
    echo json_encode($response);
  }

  mysqli_close($conn);
}

?>
