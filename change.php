<?php include 'connect.php';
$price2 = $_GET["price_change"];
$id = $_GET["Product_code"];
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
?>