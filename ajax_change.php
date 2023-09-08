<?php include 'connect.php';
$sql = "select * from testStock";

$result = $conn->query($sql);
$result = mysqli_query($conn,$sql);

if ($conn->query($sql) === false) {
    echo "Error" . $sql . "<br>" . $conn->error;
}
header('Content-Type: application/json');
$price_change = $_POST["price_change"];
$Product_code = $_POST["Product_code"];
$sql = "UPDATE testStock
        SET Unit_price = '$price_change'
        WHERE Product_code = '$Product_code'";
if (mysqli_query($conn, $sql)) {
    $response = array(
        'status' => 1,
        'message' => 'Data updated successfully.',
        'new_price' => $price_change,
        'product_code' => $Product_code,
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 0,
        'message' => 'Error updating data!  Please Enter Price again. ',
    );
    echo json_encode($response);
}
mysqli_close($conn);
?>
<?php

?>