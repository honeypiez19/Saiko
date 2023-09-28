<!-- connect database, searchbox and navbar menu -->
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
</head>

<body>
    <?php include 'header_nav.php' ?>

    
    <div class="container myform" style="margin-top: 50px;">
    <div class="row justify-content-end" style="padding-right:10px;">
        <div class="col-2" style="margin-top: 30px;"><a type="button" class="btn btn-outline-info btn-lg">Import</a></div>
    </div>
        <h1 class="heading" style="margin-top: 10px; margin-bottom: 20px">เพิ่มสินค้า</h1>
        <!-- table product -->
        <table class="table table-borderless">
            <?php
            $codeErr = $nameErr = $qtyErr = $unitErr = $unit_priceErr = $minErr = $maxErr = "";
            $Product_code = $Product_name = $Qty = $Unit = $Unit_price = $Min = $Max = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["Product_code"])) {
                    $codeErr = "กรุณากรอกรหัสสินค้า";
                }
                if (empty($_POST["Product_name"])) {
                    $nameErr = "กรุณากรอกชื่อสินค้า";
                }
                if (empty($_POST["Qty"])) {
                    $qtyErr = "กรุณากรอกจำนวน";
                }
                if (empty($_POST["Unit"])) {
                    $unitErr = "กรุณากรอกหน่วย";
                }
                if (empty($_POST["Unit_price"])) {
                    $unit_priceErr = "กรุณากรอกราคาต่อหน่วย";
                }
                if (empty($_POST["Residual_value"])) {
                    $Residual_valueErr = "กรุณากรอกมูลค่าคงเหลือ";
                }
                if (empty($_POST["Min"])) {
                    $minErr = "กรุณากรอกจำนวนขั้นต่ำ";
                }
                if (empty($_POST["Max"])) {
                    $maxErr = "กรุณากรอกจำนวนสูงสุด";
                }
            } ?>
            <thead>
                <tr class="text-center">
                    <td style='width:25%'></td>
                    <td style='width:15%'></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <form method="post" class="myform">
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            รหัสสินค้า :
                        </td>
                        <td><input class="myform" type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                            <span class="error">* <?php echo $codeErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            ชื่อสินค้า :
                        </td>
                        <td><input class="myform" type="text" name="Product_name" value="<?php echo $Product_name; ?>">
                            <span class="error">* <?php echo $nameErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            จำนวน :
                        </td>
                        <td><input class="myform" type="text" name="Qty" value="<?php echo $Qty; ?>">
                            <span class="error">* <?php echo $qtyErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            หน่วย :
                        </td>
                        <td><input class="myform" type="text" name="Unit" value="<?php echo $Unit; ?>">
                            <span class="error">* <?php echo $unitErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            ราคาต่อหน่วย :
                        </td>
                        <td><input class="myform" type="text" name="Unit_price" value="<?php echo $Unit_price; ?>">
                            <span class="error">* <?php echo $unit_priceErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            จำนวนขั้นต่ำ :
                        </td>
                        <td><input class="myform" type="text" name="Min" value="<?php echo $Min; ?>">
                            <span class="error">* <?php echo $minErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td></td>
                        <td>
                            จำนวนสูงสุด :
                        </td>
                        <td><input class="myform" type="text" name="Max" value="<?php echo $Max; ?>">
                            <span class="error">* <?php echo $maxErr; ?></span>
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td colspan="3" class="text-end" style="padding-right: 250px;">
                            <input type="submit" name="submit" class="btn btn-outline-success btn-lg" value="Submit">&emsp;&emsp;
                            <input type="reset" name="reset" class="btn btn-outline-warning btn-lg" value="Reset">
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
        <!-- end table product -->
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["Product_code"])) {
        $Product_code = $_REQUEST['Product_code'];
        $Product_name = $_REQUEST['Product_name'];
        $Qty = $_REQUEST['Qty'];
        $Unit = $_REQUEST['Unit'];
        $Unit_price = $_REQUEST['Unit_price'];
        $Min = $_REQUEST['Min'];
        $Max = $_REQUEST['Max'];
        $sql = "INSERT INTO AddNewStock (Product_code,Product_name,Qty,Unit,Unit_price,Min,Max) 
                VALUES ('$Product_code','$Product_name','$Qty','$Unit','$Unit_price','$Min','$Max')";

        if ($conn->query($sql) === false) {
            echo "<script>
            Swal.fire({
                title: 'error',
                text: 'Data insert unsuccess! ',
                icon: 'error',
            });
        </script>";
            //. $sql . "<br>" . $conn->error;
        } else {
            echo "<script>
            Swal.fire({
                title: 'success',
                text: 'Data inserted successfully!',
                icon: 'success',
            });
        </script>";
        }

        mysqli_close($conn);
    }
    ?>
    <script>
        // prevent alert Confirm Form Resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</body>

</html>