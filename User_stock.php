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
    <div class="container">
        <div class="row justify-content-md-center">
            <h1 class="heading">รายการสินค้า</h1>
            <!-- table product -->
            <table class="table" style="width:90%">
                <thead>
                    <tr class="text-center">
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>หน่วย</th>
                        <th>สถานะ</th>
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
                        <td class='text-center table-danger'> " . "เบิกได้ไม่เกิน  " . $row['Qty'] . "</td>
                    </tr> ";
                        } else {
                            echo "<tr class='align-middle'>
                        <td> " . $row['Product_code'] . "</td>
                        <td> " . $row['Product_name'] . "</td>
                        <td class='text-center'> " . $row['Qty'] . "</td>
                        <td class='text-center'> " . $row['Unit'] . "</td>
                        <td class='text-center'> " . "ปกติ" . "</td>
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
    </div>
</body>

</html>