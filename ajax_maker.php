<?php
 include 'connect.php';
 header('Content-Type: application/json');
  if (isset($_POST['function']) && $_POST['function'] == 'province') {
  	$id = $_POST['id'];
  	$sql = "select DISTINCT District from Province where Province='$id'";
  	$query = mysqli_query($conn, $sql);
  	echo '<option value="" selected disabled>-กรุณาเลือก เขต/อำเภอ-</option>';
  	foreach ($query as $value) {
  		echo '<option value="'.$value['District'].'">'.$value['District'].'</option>';
  		
  	}
  }


if (isset($_POST['function']) && $_POST['function'] == 'district') {
    $id = $_POST['id'];
    $sql = "select Sub_district from Province where District='$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-กรุณาเลือก แขวง/ตำบล-</option>';
    foreach ($query as $value2) {
      echo '<option value="'.$value2['Sub_district'].'">'.$value2['Sub_district'].'</option>';
      
    }
  }

  if (isset($_POST['function']) && $_POST['function'] == 'sub_district') {
    $id = $_POST['id'];
    $sql = "select Postcode from Province where Sub_district='$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    echo $result['Postcode'];
    //exit();
  }
  
  if (isset($_POST['function']) && $_POST['function'] == 'taxid') {
    $id = $_POST['id'];
    $sql = "select * from Maker where TaxID ='$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    foreach ($query as $result) {
      $ComName = $result['Company_name'];
      $MajorName = $result['Major_name'];
      $tel = $result['Tel_one'];
    }
    //echo $ComName;
    $value = array(
      'CompanyName' => $result['Company_name'],
      'MajorName' => $result['Major_name'],
      'AddrNo' => $result['Addr_no'],
      'Moo'=> $result['Moo_no'],
      'Building'=> $result['Building'],
      'Floor'=> $result['Floor'],
      'Room'=> $result['Room'],
      'Soi'=> $result['Soi'],
      'Road'=> $result['Road'],
      'sub_district'=> $result['Sub_district'],
      'district'=> $result['District'],
      'province'=> $result['Province'],
      'postcode'=> $result['Postcode'],
      'Fax'=> $result['Fax'],
      'TelOne'=> $result['Tel_one'],
      'TelTwo'=> $result['Tel_two'],
      'TelThree'=> $result['Tel_three'],
      'MailOne' => $result['Email_one'],
      'MailTwo' => $result['Email_two'],
    );
    echo json_encode($value);
    }
?>