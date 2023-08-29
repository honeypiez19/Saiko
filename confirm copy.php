<!-- connect database, searchbox and navbar menu -->
<?php include 'searchbox.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/bootstrap_531.min.js"></script>
    <script src="js/jquery_370.min.js"></script>
    <!-- <script src="js/jquery_111.min.js"></script> -->

</head>

<body>
    <!-- table product -->
    <div class="container">
        <h1 class="heading">รายการสินค้า</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th class="text-center">จำนวน</th>
                    <th>หน่วย</th>
                    <th class="text-center">ราคาต่อหน่วย</th>
                    <th class="text-center">มูลค่าคงเหลือ</th>
                    <th>แก้ไขราคา</th>
                </tr>
            </thead>
            <tbody>
                <!-- connect database -->
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr class="align-middle">
                        <td><?php echo $row['Product_code']; ?></td>
                        <td><?php echo $row['Product_name']; ?></td>
                        <td class="text-center"><?php echo $row['Qty']; ?></td>
                        <td><?php echo $row['Unit']; ?></td>
                        <td class="text-center"><?php echo $row['Unit_price']; ?></td>
                        <td class="text-center"><?php echo $row['Residual_value']; ?></td>
                        <td>
                            <form method="post" action="" id="form">
                                <input type="hidden" name="Product_code" class="txtField" value="<?php echo $row['Product_code']; ?>">
                                <input type="text" name="price_change" placeholder="ราคา">
                                <button type="submit" id="submit" class="btn btn-warning">แก้ไข</button>
                            </form>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#submit").click(function() {
                                        $.ajax({
                                            type: "post",
                                            url: "change.php",
                                            data: $("#form").serialize(),
                                            success: function(result) {
                                                if (result.status == 1) {
                                                    alert(result.message);
                                                } else {
                                                    alert(result.message);
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                <?php endwhile ?>
                <?php $conn->close(); ?>
                <!-- end connect database -->

            </tbody>
        </table>
        <!-- end table product -->
    </div>

</body>

</html>