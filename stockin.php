<!-- connect database, searchbox and navbar menu -->
<?php include 'connect.php';
$PONo = null;
if (isset($_POST["PO_No"])) {
    $PONo = $_POST["PO_No"];
}
$sql = "SELECT * FROM Stockin WHERE PONo = '$PONo' order by Product_code";
$result = mysqli_query($conn, $sql);

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
    <div class="container myform" style="margin-top: 50px;">
        <h1 class="heading" style="margin-top: 60px;">รับของ</h1>
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
            <div class="row" style="font-size: 20px; margin-top:40px; margin-bottom:30px">
                <div class="col-1">
                    รหัส P.O. :
                </div>
                
                <div class="col-3" style="vertical-align: text-top;">
                    <!-- send name="PO_no" to check in database -->
                    <input class="myform" list="POlist" autocomplete="off" style="width:300px; height:40px" type="text" name="PO" value="<?php echo $PONo; ?>">
                    <input name="PO_No" type="hidden" value="">
                    <!-- datalist show PONo of database -->
                    <datalist id="POlist">
                        <?php
                        $sql2 = "SELECT DISTINCT PONo FROM Stockin ";
                        $query2 = mysqli_query($conn, $sql2);
                        foreach ($query2 as $row) { ?>
                            <option value="<?= $row['PONo'] ?>"><?= $row['PONo'] ?></option>
                        <?php } ?>
                    </datalist>
                </div>

                <div class="col">
                    <input type="submit" name="submit" id="submit" class="btn btn-outline-success" value="ค้นหา"><br>
                </div>
            </div>
        </form>
        <!-- table show details -->
        <table class="table table-bordered" style="margin-bottom: 30px;">
            <thead>
                <tr class="text-center">
                    <th>ลำดับ</th>
                    <th>เลข P.O.</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>วันที่รับเข้า</th>
                </tr>
            </thead>
            <tbody>
                <!-- connect database from sql after search PONo -->
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) : ?>
                    <tr class="align-middle">
                        <td class="text-center"><?php echo $no; ?></td>
                        <td class="text-center"><?php echo $row['PONo']; ?></td>
                        <td class="text-center"><?php echo $row['Product_code']; ?></td>
                        <td><?php echo $row['Product_name']; ?></td>
                        <td class="text-center"><?php echo $row['Qty']; ?></td>
                        <td class="text-center"><?php echo $row['Unit']; ?></td>
                        <td class="text-end"><?php echo $row['Unit_price']; ?></td>
                        <td class="text-center"><?php echo $row['Date_add']; ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endwhile ?>
                <?php $conn->close(); ?>
                <!-- end connect database -->
            </tbody>
        </table>
        <!-- end table details -->
    </div>
    <script>
        // send value of input P.O. to input name="PO_No" for search P.O.
        $('#submit').click(function() {
            var Po_no = $('[name="PO"]').val();
            $('[name="PO_No"]').val(Po_no);

        });

        // reset value of input P.O.
        $('table > tbody').ready(function() {
            $('[name="PO"]').val('');
        });

        // prevent alert Confirm Form Resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>