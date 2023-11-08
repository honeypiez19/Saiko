<?php
include 'connect.php';
header('Content-Type: application/json');
////////////////////////////////////////////////////////////////////////////////////////// ajax insert to P.O. db (get value from modal in Stock page)
if (isset($_POST['function']) && $_POST['function'] == 'po_insert') {
  $PONo = $_POST['PONo'];
  $Datetime = $_POST['date'];
  $arr = $_POST['arrCode'];
  $maker = $_POST['maker'];
  $makerName = $_POST['makerName'];
  $makerAddr = $_POST['makerAddr'];
  $mail1 = $_POST['mail1'];
  $mail2 = $_POST['mail2'];
  foreach ($arr as $joinCol) {
    $PCode = $joinCol['PCode'];
    $PName = $joinCol['Pname'];
    $Purchase = $joinCol['Pqty'];
    $PUnit = $joinCol['Punit'];
    $Price = $joinCol['Price'];

    $status = 2;
    $sql1 = "INSERT INTO PO (PONo,Product_code,Product_name,Qty,Unit,Unit_price,Status,Date_cre,TaxID,Company_name,Address,Email_one,Email_two)
          VALUE  ('$PONo','$PCode', '$PName', '$Purchase', '$PUnit', '$Price', '$status', '$Datetime','$maker','$makerName','$makerAddr','$mail1','$mail2')";
    $query1 = mysqli_query($conn, $sql1);

    $sql2 = "UPDATE Stock SET Status = '$status' WHERE Product_code = '$PCode'";
    $query2 = mysqli_query($conn, $sql2);
  }
  mysqli_close($conn);
}
////////////////////////////////////////////////////////////////////////////////////////// ajax send product min of stock (modal in Stock page)
if (isset($_POST['function']) && $_POST['function'] == 'min_stock') {
  $sql = "select * from Stock";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $row) {
    if ($row['Qty'] < $row['Min'] && $row['Status'] == 1) {
      $value[] = array(
        'code' => $row['Product_code'],
        'name' => $row['Product_name'],
        'qty' => $row['Max'] - $row['Qty'],
        'unit' => $row['Unit'],
        'price' => $row['Unit_price'],
      );
    }
  }
  echo json_encode($value);
}
////////////////////////////////////////////////////////////////////////////////////////// ajax when select maker then send product min of maker (modal in Stock page)
if (isset($_POST['function']) && $_POST['function'] == 'master') {
  $maker = $_POST['maker'];
  $sql = "SELECT Orders.TaxID, S.Product_code, S.Product_name, S.Qty, S.Unit, S.Unit_price, S.Min, S.Max, S.Status
          FROM Orders 
          INNER JOIN Stock S
          ON Orders.Product_code = S.Product_code
          WHERE TaxID = '$maker'";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $row) {
    if ($row['Qty'] < $row['Min'] && $row['Status'] == 1) {
      $value[] = array(
        'code' => $row['Product_code'],
        'name' => $row['Product_name'],
        'qty' => $row['Max'] - $row['Qty'],
        'unit' => $row['Unit'],
        'price' => $row['Unit_price'],
      );
    }
  }
  echo json_encode($value);
}
////////////////////////////////////////////////////////////////////////////////////////// ajax send info of maker (modal in Stock page)
if (isset($_POST['function']) && $_POST['function'] == 'maker') {
  $maker = $_POST['maker'];
  $sql = "SELECT * FROM Orders WHERE TaxID = '$maker' ";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  $value = array(
    'name' => $result['Company_name'],
    'addr' => $result['Address'],
    'mail1' => $result['Email_one'],
    'mail2' => $result['Email_two'],
  );
  echo json_encode($value);
}
////////////////////////////////////////////////////////////////////////////////////////// ajax send info of maker (in form of PO page)
if (isset($_POST['function']) && $_POST['function'] == 'po_maker') {
  $getPONo = $_POST['PONo'];
  $sql = "SELECT DISTINCT * FROM PO WHERE PONo = '$getPONo'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);
  $value = array(
    'taxID' => $row['TaxID'],
    'name' => $row['Company_name'],
    'addr' => $row['Address'],
  );
  echo json_encode($value);
}
////////////////////////////////////////////////////////////////////////////////////////// ajax send row of product from P.O. db (in from of PO page)
if (isset($_POST['function']) && $_POST['function'] == 'po_details') {
  $getPONo = $_POST['PONo'];
  $sql = "select * from PO where PONo ='$getPONo'";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $row) {
    $amount = $row['Qty'] * $row['Unit_price'];
    $value[] = array(
      'poNo' => $getPONo,
      'code' => $row['Product_code'],
      'name' => $row['Product_name'],
      'qty' => $row['Qty'],
      'unit' => $row['Unit'],
      'price' => $row['Unit_price'],
      'amount' => number_format($amount,2),
    );
  }
  echo json_encode($value);
}
////////////////////////////////////////////////////////////////////////////////////////// ajax send amount of PO (in from of PO page)
if (isset($_POST['function']) && $_POST['function'] == 'po_amount') {
  $getPONo = $_POST['PONo'];
  $sql = "select * from PO where PONo ='$getPONo'";
  $query = mysqli_query($conn, $sql);
  $sub_total = 0;
  $discount = 0;
  $grand = 0;

  // function convert number to text
  function gettxt(
    $value,
    $locale = 'en',
    $style = NumberFormatter::SPELLOUT
  ) {
    $fmt = new NumberFormatter($locale, $style);
    return $fmt->format($value);
  }

  foreach ($query as $row) {
    $amount = $row['Qty'] * $row['Unit_price'];
    $sub_total += sprintf("%.2f", $amount);
  }
  $total = $sub_total - $discount;
  $vat = $total * 0.07;
  $grand = $total + sprintf("%.2f", $vat);

  // check if grand is decimal
  $txtgrand = sprintf("%.2f",$grand);
  if (fmod($txtgrand, 1) !== 0.0) {
    $num = intval($txtgrand); // cut only number not decimal
    $txtnum = gettxt($num); // call function gettxt for convert num to txt
    $digit = number_format($txtgrand - $num, 2); // grand - num and fix decimal 2 digit
    $subdigit = substr($digit, 2); // cut only digit of grand - num

    // check decimal
    switch ($subdigit) {
      case '01':
        $decimal = '01';
        break;
      case '02':
        $decimal = '02';
        break;
      case '03':
        $decimal = '03';
        break;
      case '04':
        $decimal = '04';
        break;
      case '05':
        $decimal = '05';
        break;
      case '06':
        $decimal = '06';
        break;
      case '07':
        $decimal = '07';
        break;
      case '08':
        $decimal = '08';
        break;
      case '09':
        $decimal = '09';
        break;
      case '10':
        $decimal = 10;
        break;
      case '20':
        $decimal = 20;
        break;
      case '30':
        $decimal = 30;
        break;
      case '40':
        $decimal = 40;
        break;
      case '50':
        $decimal = 50;
        break;
      case '60':
        $decimal = 60;
        break;
      case '70':
        $decimal = 70;
        break;
      case '80':
        $decimal = 80;
        break;
      case '90':
        $decimal = 90;
        break;
      default:
        $decimal = $subdigit;
    }
    // }

    $txtdigit = gettxt($decimal); // call function gettxt for convert subdigit to txt
    $resultConvertText = "( " . strtoupper($txtnum) . " BAHT AND " . strtoupper($txtdigit) . " STANG )";
  } else {
    $resultConvertText = "( " . strtoupper(gettxt($txtgrand)) . " BAHT )";
  }
  $row_po = array(
    'poNo' => $getPONo,
    'sub' => number_format($sub_total,2),
    'dis' => number_format($discount,2),
    'vat' => number_format($vat,2),
    'total' => number_format($total,2),
    'grand' => number_format($grand,2),
    'text' => $resultConvertText,
  );
  echo json_encode($row_po);
}
