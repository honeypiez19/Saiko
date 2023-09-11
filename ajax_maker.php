<?php
include 'connect.php';

header('Content-Type: application/json');
if (isset($_POST['function']) && $_POST['function'] == 'taxid') {
  $id = $_POST['id'];
  $sql = "select * from Maker where TaxID ='$id'";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  $value = array(
    'CompanyName' => $result['Company_name'],
    'MajorName' => $result['Major_name'],
    'AddrNo' => $result['Addr_no'],
    'Moo' => $result['Moo_no'],
    'Building' => $result['Building'],
    'Floor' => $result['Floor'],
    'Room' => $result['Room'],
    'Soi' => $result['Soi'],
    'Road' => $result['Road'],
    'sub_district' => $result['Sub_district'],
    'district' => $result['District'],
    'province' => $result['Province'],
    'postcode' => $result['Postcode'],
    'Fax' => $result['Fax'],
    'TelOne' => $result['Tel_one'],
    'TelTwo' => $result['Tel_two'],
    'TelThree' => $result['Tel_three'],
    'MailOne' => $result['Email_one'],
    'MailTwo' => $result['Email_two'],
  );
  echo json_encode($value);
}

if (isset($_POST['function']) && $_POST['function'] == 'submit-new') {
  $TaxID = $_POST['TaxID'];
  $Company_name = $_POST['Company_name'];
  $MajorName = $_POST['MajorName'];
  $Addr = $_POST['Addr'];
  $Moo = $_POST['Moo'];
  $Building = $_POST['Building'];
  $Floor = $_POST['Floor'];
  $Room = $_POST['Room'];
  $Soi = $_POST['Soi'];
  $Road = $_POST['Road'];
  $Sub_district = $_POST['Sub_district'];
  $District = $_POST['District'];
  $Province = $_POST['Province'];
  $Postcode = $_POST['Postcode'];
  $Fax = $_POST['Fax'];
  $TelOne = $_POST['TelOne'];
  $TelTwo = $_POST['TelTwo'];
  $TelThree = $_POST['TelThree'];
  $MailOne = $_POST['MailOne'];
  $MailTwo = $_POST['MailTwo'];
  $sql = "INSERT INTO Maker (TaxID, Company_name, Major_Name, Addr_no, Moo_no, Building, Floor, Room, Soi, Road, 
          Sub_district, District, Province, Postcode, Fax, Tel_one, Tel_two, Tel_three, Email_one, Email_two)
          VALUE  ('$TaxID', '$Company_name', '$MajorName', '$Addr', '$Moo', '$Building', '$Floor', '$Room', '$Soi', '$Road',
           '$Sub_district', '$District', '$Province', '$Postcode', '$Fax', '$TelOne', '$TelTwo', '$TelThree', '$MailOne', '$MailTwo')";
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

if (isset($_POST['function']) && $_POST['function'] == 'submit-update') {
    $TaxID = $_POST['TaxID'];
    $Company_name = $_POST['Company_name'];
    $MajorName = $_POST['MajorName'];
    $Addr = $_POST['Addr'];
    $Moo = $_POST['Moo'];
    $Building = $_POST['Building'];
    $Floor = $_POST['Floor'];
    $Room = $_POST['Room'];
    $Soi = $_POST['Soi'];
    $Road = $_POST['Road'];
    $Sub_district = $_POST['Sub_district'];
    $District = $_POST['District'];
    $Province = $_POST['Province'];
    $Postcode = $_POST['Postcode'];
    $Fax = $_POST['Fax'];
    $TelOne = $_POST['TelOne'];
    $TelTwo = $_POST['TelTwo'];
    $TelThree = $_POST['TelThree'];
    $MailOne = $_POST['MailOne'];
    $MailTwo = $_POST['MailTwo'];
    $sql = "UPDATE Maker
            SET Company_name = '$Company_name', Major_Name = '$MajorName', Addr_no = '$Addr', Moo_no = '$Moo', Building = '$Building',
            Floor = '$Floor', Room = '$Room', Soi = '$Soi', Road = '$Road', Sub_district = '$Sub_district', District = '$District', Province = '$Province', 
            Postcode = '$Postcode', Fax = '$Fax', Tel_one = '$TelOne', Tel_two = '$TelTwo', Tel_three = '$TelThree', Email_one = '$MailOne', Email_two = '$MailTwo' 
            WHERE TaxID = '$TaxID'";
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
