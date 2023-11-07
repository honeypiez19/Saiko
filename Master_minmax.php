<!-- connect database -->
<?php include 'connect.php' ?>
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
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/moment.min.js"></script>
</head>

<body>
    <!-- navbar menu -->
    <?php include 'header_nav.php' ?>

    <div class="container myform" style="margin-top: 50px;">
        <div class="row justify-content-end" style="padding-right:10px;">
            <div class="col-2" style="margin-top: 30px;"><a type="button" class="btn btn-outline-info btn-lg">Import</a></div>
        </div>
        <h1 class="heading" style="margin-top: 30px; margin-bottom: 60px">แก้ไขจำนวนขั้นต่ำและจำนวนสูงสุด</h1>
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
            <div class="row" style="font-size: 20px; margin-top:40px; margin-bottom:30px">
                <div class="col-1"></div>
                <div class="col-8" style="vertical-align: text-top;">
                    <span>&emsp;ค้นหารหัสสินค้าหรือชื่อสินค้า : &emsp;</span>
                    <!-- send name="Pcode" to check in database -->
                    <input class="myform" list="Productlist" autocomplete="off" style="width:550px; height:40px" type="search" name="P_code" value="">
                    <input name="Pcode" type="hidden" value="">
                    <!-- datalist show Pcode of database -->
                    <datalist id="Productlist">
                        <?php
                        $sql2 = "SELECT Product_code, Product_name FROM Product ";
                        $query2 = mysqli_query($conn, $sql2);
                        foreach ($query2 as $row) { ?>
                            <option value="<?= $row['Product_code'] ?>"><?= $row['Product_name'] ?></option>
                        <?php } ?>
                    </datalist>
                </div>

                <div class="col-1">
                    <input type="submit" id="submit" class="btn btn-outline-success" value="ค้นหา">
                </div>
            </div>
        </form>

        <h3 class="heading">รายการสินค้า</h3>
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr class="text-center">
                    <th>ลำดับที่</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>หน่วย</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>จำนวนขั้นต่ำ</th>
                    <th>จำนวนสูงสุด</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody id="body">
                <!-- function search -->
                <?php
                $Pcode = null;
                if (isset($_POST["Pcode"])) {
                    $Pcode = $_POST["Pcode"];
                    if ($Pcode == '') {
                        $sql = "SELECT * FROM Product";
                        $result = mysqli_query($conn, $sql);
                    } else {
                        $sql = "SELECT * FROM Product WHERE Product_code = '$Pcode' order by Product_code";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) == 0) {
                            echo '<script>
                                    Swal.fire({
                                        title: "Not found!",
                                        text: "ไม่มีรหัสสินค้านี้",
                                        icon: "error",
                                    }); 
                                    </script>';
                        }
                    }
                } else {
                    $sql = "SELECT * FROM Product";
                    $result = mysqli_query($conn, $sql);
                }

                if ($conn->query($sql) === false) {
                    echo "Error" . $sql . "<br>" . $conn->error;
                } ?>
                <!-- function search -->
                <form>
                    <!-- connect database -->
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()) :
                        $trow = "<tr class='align-middle' >";
                        $colindx = "<td class='text-center'> " . $no . "</td>";
                        $colCode = "<td id='code" . $no . "'>" . $row['Product_code'] . "</td>";
                        $colName = "<td> " . $row['Product_name'] . "</td>";
                        $colUnit = "<td class='text-center'> " . $row['Unit'] . "</td>";
                        $colPrice = "<td class='text-end'> " . $row['Unit_price'] . "</td>";
                        $colMin = "<td class='text-center'><input style='text-align:center' type='text' id='min" . $no . "' class='myform' size='5' value='" . $row['Min'] . "'></td>";
                        $colMax = "<td class='text-center'><input style='text-align:center' type='text' id='max" . $no . "' class='myform' size='5' value='" . $row['Max'] . "'></td>";
                        $colsave = "<td class='text-center'><input type='button' class='btn btn-outline-primary btn-save' id='" . $no . "' onclick='indxRow(this)' value='บันทึก'></td></tr>";

                        echo $trow . $colindx . $colCode . $colName . $colUnit . $colPrice . $colMin . $colMax . $colsave;
                        $no++;
                    ?>
                    <?php endwhile ?>
                    <?php $conn->close(); ?>
                    <!-- end connect database -->
                </form>
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        $('#submit').click(function() {
            var ProductCode = $('[name="P_code"]').val();
            $('[name="Pcode"]').val(ProductCode);
        });

        function indxRow(i) {
            var n = $(i).attr("id");
            var code = $("#code" + n).html();
            var newMin = $("#min" + n).val();
            var newMax = $("#max" + n).val();
            const d = new Date();
            var date_upd = moment(d).format('YYYY-MM-DD hh:mm:ss');
            $.ajax({
                type: "post",
                url: "ajax_MasterUpdate.php",
                data: {
                    Pcode: code,
                    Pmin: newMin,
                    Pmax: newMax,
                    date: date_upd,
                    function: 'minmax'
                },
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Data update successfully!',
                            icon: 'success',
                        });
                        $("#min" + n).css("color", "MediumSeaGreen")
                        $("#min" + n).css("font-weight", "bold")
                        $("#max" + n).css("color", "MediumSeaGreen")
                        $("#max" + n).css("font-weight", "bold")
                    } else if (data.status == 2) {
                        Swal.fire({
                            title: 'Data not change!',
                            icon: 'info',
                        });
                    } else if (data.status == 'min') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Data update Min successfully!',
                            icon: 'success',
                        });
                        $("#min" + n).css("color", "MediumSeaGreen")
                        $("#min" + n).css("font-weight", "bold")
                    } else if (data.status == 'max') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Data update Max successfully!',
                            icon: 'success',
                        });
                        $("#max" + n).css("color", "MediumSeaGreen")
                        $("#max" + n).css("font-weight", "bold")
                    } else {
                        Swal.fire({
                            title: 'Error:',
                            text: data.message,
                            icon: 'error',
                        });
                    }
                }
            });
        }

        $(window).on("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                $('#submit').click();
            }
        });

        // prevent alert Confirm Form Resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>