<?php include 'connect.php';
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
        'message' => 'Error updating data: ' . mysqli_error($conn),
    );
    echo json_encode($response);
}

// $query = mysqli_query($conn, $sql);
// if ($query) {
//     echo json_encode(array('status' => '1', 'message' => 'Record add successfully'));
// } else {
//     echo json_encode(array('status' => '0', 'message' => 'Error insert data!'));
// }
mysqli_close($conn);
?>
<?php

?>