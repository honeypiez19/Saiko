<?php
 include 'connect.php';

  if (isset($_POST['function']) && $_POST['function'] == 'province') {
  	$id = $_POST['id'];
  	$sql = "select DISTINCT District from Province where Province='$id'";
  	$query = mysqli_query($conn, $sql);
    echo $id;
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
    $query3 = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query3);
    echo $result['Postcode'];
    exit();
  }
?>