<?php
include 'connect.php';

header('Content-Type: application/json');

if (isset($_POST['function']) && $_POST['function'] == 'po_insert') {
  $PONo = $_POST['PONo'];
  $sql = "select * from Stock";
  $query = mysqli_query($conn, $sql);

  foreach ($query as $row) {
    if ($row['Qty'] < $row['Min']) {
      $PCode = $row['Product_code'];
      $PName = $row['Product_name'];
      $Purchase = $row['Max'] - $row['Qty'];
      $PUnit = $row['Unit'];
      $Price = $row['Unit_price'];

      $sql2 = "INSERT INTO PO (PONo,Product_code,Product_name,Qty,Unit,Unit_price)
               VALUE  ('$PONo','$PCode', '$PName', '$Purchase', '$PUnit', '$Price')";
      $query = mysqli_query($conn, $sql2);
    }
  }
}

if (isset($_POST['function']) && $_POST['function'] == 'po_details') {
  $getPONo = $_POST['PONo'];
  $sql = "select * from PO where PONo ='$getPONo'";
  $query = mysqli_query($conn, $sql);
  $n = 0;

  foreach ($query as $row) {
    $amount = $row['Qty'] * $row['Unit_price'];
    $n++;
    $value[] = array(
      'poNo' => $getPONo,
      'code' => $row['Product_code'],
      'name' => $row['Product_name'],
      'qty' => $row['Qty'],
      'unit' => $row['Unit'],
      'price' => $row['Unit_price'],
      'amount' => sprintf("%.2f", $amount),
    );
    //$obj = (object)$value;
  }
  echo json_encode($value);
}

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
  $grand = $total + $vat;

  // check if grand is decimal
  $txtgrand = sprintf("%.2f", $grand);
  if (fmod($txtgrand, 1) !== 0.0) {
    $num = intval($txtgrand); // cut only number not decimal
    $txtnum = gettxt($num); // call function gettxt for convert num to txt
    $digit = round($txtgrand - $num, 2); // grand - num and fix decimal 2 digit
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
    'sub' => sprintf("%.2f", $sub_total),
    'dis' => sprintf("%.2f", $discount),
    'vat' => sprintf("%.2f", $vat),
    'total' => sprintf("%.2f", $total),
    'grand' => sprintf("%.2f", $grand),
    'text' => $resultConvertText,
  );
  echo json_encode($row_po);
}
