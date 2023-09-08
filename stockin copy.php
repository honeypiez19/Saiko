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
</head>

<body>
    <?php include 'header_nav.php' ?>
    <!-- table product -->
    <div class="container">
        <h1 class="heading" style="margin-top: 60px;">รับของ</h1>

        <table class="table table-striped">
            <?php
            $poErr = "";
            $PO_no = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["PO_no"])) {
                    $poErr = "กรุณากรอกรหัส P.O.";
                }
            } ?>
            <thead>
                <tr class="text-center">
                    <td>&emsp;</td>
                    <td style='width:15%'></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
                    <tr style="font-size: 20px;">
                        <td>&emsp;</td>
                        <td>
                            รหัส P.O. :
                        </td>
                        <td><input type="text" name="PO_no" value="<?php echo $PO_no; ?>">
                            <span class="error">* </span>&emsp;&emsp;
                            <input type="submit" name="submit" class="btn btn-outline-success btn-lg" value="บันทึก"><br>
                            <span class="error"> <?php echo $poErr; ?></span><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td>&emsp;</td>
                        <td>
                            รหัสสินค้า :
                        </td>
                        <td><input type="text" name="Product_name" value="">
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td>&emsp;</td>
                        <td>
                            ชื่อสินค้า :
                        </td>
                        <td><input type="text" name="Product_name" value="">
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td>&emsp;</td>
                        <td>
                            จำนวน :
                        </td>
                        <td><input type="text" name="Qty" value="">
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td>&emsp;</td>
                        <td>
                            หน่วย :
                        </td>
                        <td><input type="text" name="Unit" value="">
                            <br><br>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td>&emsp;</td>
                        <td>
                            ราคาต่อหน่วย :
                        </td>
                        <td><input type="text" name="Unit_price" value="">
                            <br><br>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
        <!-- end table product -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-change-price").click(function() {
                var button = $(this);
                var form = button.closest("form");
                var productCode = form.find(".product-code").val();
                var priceChange = form.find(".price-change").val();

                $.ajax({
                    type: "post",
                    url: "change.php",
                    data: {
                        Product_code: productCode,
                        price_change: priceChange
                    },
                    success: function(result) {
                        if (result.status == 1) {
                            alert(result.message);
                            // อัปเดตราคาในตารางหลังจากแก้ไขและแสดงเป็นทศนิยม 2 ตำแหน่ง
                            var formattedPrice = parseFloat(priceChange).toFixed(2);
                            form.closest("tr").find(".unit-price").text(formattedPrice);
                        } else {
                            alert(result.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>