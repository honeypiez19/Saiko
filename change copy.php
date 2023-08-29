<?php include 'connect.php';
header('Content-Type: application/json');
$price2 = $_POST["price_change"];
$id = $_POST["Product_code"];
$sql = "UPDATE testStock 
SET Unit_price = '$price2' 
WHERE Product_code = '$id'";
if (mysqli_query($conn, $sql)) {
    echo "data stored in a database successfully.";
    echo nl2br("\n$price2");
    echo nl2br("\n$id");
} else {
    echo "ERROR: $sql. "
        . mysqli_error($conn);
}
$query = mysqli_query($conn,$sql);
// if ($query) {
//     echo json_encode(array('status' => '1', 'message' => 'Record add successfully'));
// } else {
//     echo json_encode(array('status' => '0', 'message' => 'Error insert data!'));
// }
mysqli_close($conn);
?>
<?php
// if (isset($_POST['submit'])) {
//     $price2 = $_POST["price_change"];
//     $id = $_POST["Product_code"];
//     $sql = "UPDATE testStock 
//             SET Unit_price = '$price2' 
//             WHERE Product_code = '$id'";
//     if (mysqli_query($conn, $sql)) {
//        
//     } else {
//         echo "Please Enter Price! ";
//     }
// }
?>