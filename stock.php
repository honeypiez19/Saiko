<!-- connect database, searchbox and navbar menu -->
<?php include 'searchbox.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/bootstrap_531.min.js"></script>

</head>

<body>
    <div class="row justify-content-end">
        <div class="col-2"><a href="PO.php" type="button" class="btn btn-outline-info btn-lg">เปิด PO</a></div>
    </div>

    <!-- table product -->
    <div class="container">

        <h1 class="heading">รายการสินค้า</h1>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>มูลค่าคงเหลือ</th>
                    <th>จำนวนขั้นต่ำ</th>
                </tr>
            </thead>
            <tbody>
                <!-- connect database -->
                <?php
                while ($row = $result->fetch_assoc()) :
                    if ($row['Qty'] < $row['Min']) {
                        echo "<tr class='align-middle'>
                        <td> " . $row['Product_code'] . "</td>
                        <td> " . $row['Product_name'] . "</td>
                        <td class='text-center table-danger'> " . $row['Qty'] . "</td>
                        <td class='text-center'> " . $row['Unit'] . "</td>
                        <td class='text-end'> " . $row['Unit_price'] . "</td>
                        <td class='text-end'> " . $row['Residual_value'] . "</td>
                        <td class='text-center'> " . $row['Min'] . "</td>
                    </tr> ";
                    } else {
                        echo "<tr class='align-middle'>
                        <td> " . $row['Product_code'] . "</td>
                        <td> " . $row['Product_name'] . "</td>
                        <td class='text-center'> " . $row['Qty'] . "</td>
                        <td class='text-center'> " . $row['Unit'] . "</td>
                        <td class='text-end'> " . $row['Unit_price'] . "</td>
                        <td class='text-end'> " . $row['Residual_value'] . "</td>
                        <td class='text-center'> " . $row['Min'] . "</td>
                    </tr> ";
                    }
                ?>
                <?php endwhile ?>
                <?php $conn->close(); ?>
                <!-- end connect database -->
            </tbody>
        </table>
        <!-- end table product -->
    </div>

</body>

</html>