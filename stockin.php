<!-- connect database, searchbox and navbar menu -->
<?php include 'connect.php';
$sql = "select * from Stock";

$result = $conn->query($sql);
$result = mysqli_query($conn,$sql);

if ($conn->query($sql) === false) {
    echo "Error" . $sql . "<br>" . $conn->error;
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/jquery_370.min.js"></script>
    <script src="js/bootstrap_531.min.js"></script>
</head>

<body>
    <?php include 'header_nav.php' ?>
    <!-- table product -->
    <div class="container">
        <h1 class="heading" style="margin-top: 60px;">รับของ</h1>
        <?php
        $poErr = "";
        $PO_no = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["PO_no"])) {
                $poErr = "กรุณากรอกรหัส P.O.";
            }
        } ?>
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
            <div class="row" style="font-size: 20px; margin-top:40px; margin-bottom:20px">
                <div class="col">
                    รหัส P.O. :
                </div>
                <div class="col-11">
                    <input type="text" name="PO_no" value="<?php echo $PO_no; ?>">
                    <span class="error">* </span>&emsp;&emsp;
                    <input type="submit" name="submit" class="btn btn-outline-success btn-lg" value="บันทึก"><br>
                    <span class="error"> <?php echo $poErr; ?></span><br>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ราคาต่อหน่วย</th>
                </tr>
            </thead>
            <tbody>
                <!-- connect database -->
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) : ?>
                    <tr class="align-middle">
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo $row['Product_code']; ?></td>
                        <td><?php echo $row['Product_name']; ?></td>
                        <td class="text-center"><?php echo $row['Qty']; ?></td>
                        <td class="text-center"><?php echo $row['Unit']; ?></td>
                        <td class="text-end"><?php echo $row['Unit_price']; ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endwhile ?>
                <?php $conn->close(); ?>
                <!-- end connect database -->
            </tbody>
        </table>
        <!-- end table product -->
    </div>
</body>

</html>