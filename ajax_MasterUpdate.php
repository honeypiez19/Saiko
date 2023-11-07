<?php
include 'connect.php';
header('Content-Type: application/json');
/////////////////////////////////////////////////////////////////////////////// Master_resetPassword
if (isset($_POST['function']) && $_POST['function'] == 'resetpass') {
  $newpass = $_POST["newpass"];
  $user = $_POST["usercode"];
  $sql = "UPDATE User SET Password = '$newpass' WHERE Usercode = '$user'";
  if (mysqli_query($conn, $sql)) {
    $response = array(
      'status' => 1,
    );
    echo json_encode($response);
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Error' . "   " . "   " . $conn->error,
    );
    echo json_encode($response);
  }
  mysqli_close($conn);
}

/////////////////////////////////////////////////////////////////////////////// Master_minmak
if (isset($_POST['function']) && $_POST['function'] == 'minmax') {
  $PCode = $_POST['Pcode'];
  $NewMin = $_POST['Pmin'];
  $NewMax = $_POST['Pmax'];
  $Date = $_POST['date'];
  $sql = "SELECT Product_code, Min, Max FROM Product WHERE Product_code = '$PCode'";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  $min = $result['Min'];
  $max = $result['Max'];

  if ($min == $NewMin && $max == $NewMax) {
    $response = array(
      'status' => 2,
    );
    echo json_encode($response);
  } else if ($min == $NewMin && $max != $NewMax) {
    $sql = "UPDATE Product SET Max = '$NewMax', Date_upd = '$Date' WHERE Product_code = '$PCode'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
      $response = array(
        'status' => 'max',
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 0,
        'message' => 'Error' . "   " . "   " . $conn->error,
      );
      echo json_encode($response);
    }
  } else if ($min != $NewMin && $max == $NewMax) {
    $sql = "UPDATE Product SET Min = '$NewMin', Date_upd = '$Date' WHERE Product_code = '$PCode'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
      $response = array(
        'status' => 'min',
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 0,
        'message' => 'Error' . "   " . "   " . $conn->error,
      );
      echo json_encode($response);
    }
  } else {
    $sql = "UPDATE Product SET Min = '$NewMin', Max = '$NewMax', Date_upd = '$Date' WHERE Product_code = '$PCode'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
      $response = array(
        'status' => 1,
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 0,
        'message' => 'Error' . "   " . "   " . $conn->error,
      );
      echo json_encode($response);
    }
  }
  mysqli_close($conn);
}

/////////////////////////////////////////////////////////////////////////////// Master_bindmaker
if (isset($_POST['function']) && $_POST['function'] == 'bindmaker') {
  $maker = $_POST["maker"];
  $sql = "SELECT TaxID FROM Orders WHERE TaxID = '$maker'";
  if ($sql == null) {
    $sql = "SELECT * FROM Stock";
    $query = mysqli_query($conn, $sql);
    foreach ($query as $row) {
      $value[] = array(
        'code' => $row['Product_code'],
        'name' => $row['Product_name'],
        'unit' => $row['Unit'],
        'price' => $row['Unit_price'],
      );
    }
    echo json_encode($value);
  } else {
    $sql = "SELECT s.*,
          CASE 
                WHEN s.Product_code IS NULL OR Ord.Product_code IS NULL THEN 'Not equal' 
                ELSE 'Equal' 
                END AS Comparison
          FROM Stock s
          left join ( SELECT Product_code
                      FROM Orders
                      where Orders.TaxID = '$maker') Ord
          on s.Product_code = Ord.Product_code
          ORDER BY s.Product_code, Ord.Product_code";
    $query = mysqli_query($conn, $sql);
    foreach ($query as $row) {
      $value[] = array(
        'compare' => $row['Comparison'],
        'code' => $row['Product_code'],
        'name' => $row['Product_name'],
        'unit' => $row['Unit'],
        'price' => $row['Unit_price'],
      );
    }
    echo json_encode($value);
  }
  mysqli_close($conn);
}

if (isset($_POST['function']) && $_POST['function'] == 'findProduct') {
  $Pcode = $_POST["ProductCode"];
  $maker = $_POST["maker"];

  if ($Pcode == '' && $maker == '') {
    $sql = "SELECT * FROM Stock";
    $query = mysqli_query($conn, $sql);
    foreach ($query as $row) {
      $value[] = array(
        'status' => 1,
        'code' => $row['Product_code'],
        'name' => $row['Product_name'],
        'unit' => $row['Unit'],
        'price' => $row['Unit_price'],
      );
    }
    echo json_encode($value);
  } else if ($Pcode != '' && $maker == '') {
    $sql = "SELECT * FROM Stock WHERE Product_code = '$Pcode' order by Product_code";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
      $value[] = array(
        'status' => 0,
        'message' => 'Not found!',
      );
    } else {
      foreach ($query as $row) {
        $value[] = array(
          'status' => 1,
          'code' => $row['Product_code'],
          'name' => $row['Product_name'],
          'unit' => $row['Unit'],
          'price' => $row['Unit_price'],
        );
      }
    }
    echo json_encode($value);
  } else if ($Pcode != '' && $maker != '') {
    $sql = "SELECT s.*,
            CASE 
                  WHEN s.Product_code IS NULL OR Ord.Product_code IS NULL THEN 'Not equal' 
                  ELSE 'Equal' 
                  END AS Comparison
            FROM Stock s
            left join ( SELECT Product_code
                        FROM Orders
                        where Orders.TaxID = '$maker' ) Ord
            on s.Product_code = Ord.Product_code
            WHERE s.Product_code = '$Pcode'
            ORDER BY s.Product_code, Ord.Product_code";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
      $value[] = array(
        'status' => 0,
        'message' => 'Not found!',
      );
    } else {
      foreach ($query as $row) {
        $value[] = array(
          'status' => 1,
          'compare' => $row['Comparison'],
          'code' => $row['Product_code'],
          'name' => $row['Product_name'],
          'unit' => $row['Unit'],
          'price' => $row['Unit_price'],
        );
      }
    }
    echo json_encode($value);
  } else {
    $sql = "SELECT s.*,
            CASE 
                  WHEN s.Product_code IS NULL OR Ord.Product_code IS NULL THEN 'Not equal' 
                  ELSE 'Equal' 
                  END AS Comparison
            FROM Stock s
            left join ( SELECT Product_code
                        FROM Orders
                        where Orders.TaxID = '$maker' ) Ord
            on s.Product_code = Ord.Product_code
            ORDER BY s.Product_code, Ord.Product_code";
    $query = mysqli_query($conn, $sql);
    foreach ($query as $row) {
      $value[] = array(
        'status' => 1,
        'compare' => $row['Comparison'],
        'code' => $row['Product_code'],
        'name' => $row['Product_name'],
        'unit' => $row['Unit'],
        'price' => $row['Unit_price'],
      );
    }
    echo json_encode($value);
  }
  mysqli_close($conn);
}

if (isset($_POST['function']) && $_POST['function'] == 'insert_bindmaker') {
  $PCode = $_POST['Pcode'];
  $maker = $_POST['id_maker'];

  $sql = "INSERT INTO Orders (TaxID, Product_code) VALUE ('$maker','$PCode')";

  if (mysqli_query($conn, $sql)) {
    $response = array(
      'status' => 1,
    );
    echo json_encode($response);
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Error' . "   " . "   " . $conn->error,
    );
    echo json_encode($response);
  }
  mysqli_close($conn);
}
