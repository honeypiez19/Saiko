<?php
 include 'connect.php';
  if (isset($_POST['function']) && $_POST['function'] == 'province') {
  	$sql = "select DISTINCT District from Province where Province='$id'";
  	$query = mysqli_query($conn, $sql);
  	echo '<option value="" selected disabled>- กรุณาเลือกผู้จำหน่าย -</option>';
  	foreach ($query as $value) {
  		echo '<option value="'.$value['TaxID'].'">'.$value['TaxID'].'</option>';
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
    exit();
  }

  if (isset($_POST['function']) && $_POST['function'] == 'dept') {
    $id = $_POST['id'];
    $sql = "select Usercode from User where Department='$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>- กรุณาเลือกรหัสพนักงาน -</option>';
    foreach ($query as $value) {
      echo '<option value="'.$value['Usercode'].'">'.$value['Usercode'].'</option>';
    }
  }
?>