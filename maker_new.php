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

    <div class="container">
        <?php
        $nameErr = "";
        $Product_code = $Product_name = $Qty = $Unit = $Unit_price = $Residual_value = $Min = $Max = "";
        function altmsg()
        {
            echo "<script>
            Swal.fire({
                title: 'error',
                text: 'Please enter data!',
                icon: 'error',
            });
        </script>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["Product_code"])) {
                altmsg();
                $nameErr = "*";
            }
            if (empty($_POST["Product_name"])) {
                $nameErr = "*";
            }
            if (empty($_POST["Qty"])) {
                $nameErr = "*";
            }
            if (empty($_POST["Unit"])) {
                $nameErr = "*";
            }
            if (empty($_POST["Unit_price"])) {
                $nameErr = "*";
            }
            if (empty($_POST["Residual_value"])) {
                $nameErr = "*";
            }
            if (empty($_POST["Min"])) {
                $nameErr = "*";
            }
            if (empty($_POST["Max"])) {
                $nameErr = "*";
            }
        } ?>
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">เพิ่มข้อมูลผู้จำหน่าย</h1>
        <!-- form -->
        <form method="post" action="">
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    TAX ID :
                </div>
                <div class="col-3">
                    <input type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-1">
                    ชื่อบริษัท :
                </div>
                <div class="col-3">
                    <input type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-1">
                    สาขา :
                </div>
                <div class="col-3">
                    <input type="text" name="Qty" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    เลขที่ :
                </div>
                <div class="col-1">
                    <input type="text" name="Product_name" size="2" value="<?php echo $Product_name; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-2">
                    <label>หมู่ที่ :</label>&emsp;&emsp;
                    <input type="text" name="Product_name" size="2" value="<?php echo $Product_name; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-1">
                    อาคาร :
                </div>
                <div class="col-3">
                    <input type="text" name="Qty" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col">
                    ชั้น :
                </div>
                <div class="col-3">
                    <input type="text" name="Product_name" size="8" value="<?php echo $Product_name; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-2">
                    <label>ห้อง :</label>&emsp;&emsp;&emsp;
                    <input type="text" name="Qty" size="2" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-2">
                    <label>ซอย :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="2" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>ถนน :</label>&emsp;&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>

                <div class="col-1">
                    จังหวัด :
                </div>
                <div class="col-3">
                    <select style="width:250px" id="province">
                        <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                        <?php
                        $sql = "select DISTINCT Province from Province";
                        $query = mysqli_query($conn, $sql);
                        foreach ($query as $r) { ?>
                            <option value="<?= $r['Province'] ?>"><?= $r['Province'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="error"> <?php echo $nameErr; ?></span>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    อำเภอ :
                </div>
                <div class="col-3">
                    <select style="width:250px" id="district">
                    </select>
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-1">
                    ตำบล :
                </div>
                <div class="col-3">
                    <select style="width:250px" id="sub_district">
                    </select>
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br>
                </div>
                <div class="col-4" style="padding:0px;">
                    &emsp;<label>รหัสไปรษณีย์ :</label>&emsp;&emsp;
                    <input type="text" size="4" name="postcode" id="postcode">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>แฟ็กซ์ :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="22" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 1 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 2 :</label>&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>เบอร์โทร 3 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 1 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 2 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col" style="margin-top:20px">
                    <input type="submit" name="submit" class="btn btn-outline-success btn-lg" value="บันทึก">
                </div>
            </div>
        </form>
        <!-- end table product -->
    </div>
    <script type="text/javascript">
        $('#province').change(function() {
            var id_province = $(this).val();

            $.ajax({
                type: "POST",
                url: "ajax_province.php",
                data: {
                    id: id_province,
                    function: 'province'
                },
                success: function(data) {
                    $('#district').html(data);
                    $('#sub_district').html(' ');
                    $('#sub_district').val(' ');
                    $('#postcode').val(' ');
                }
            });
        });

        $('#district').change(function() {
            var id_district = $(this).val();

            $.ajax({
                type: "POST",
                url: "ajax_province.php",
                data: {
                    id: id_district,
                    function: 'district'
                },
                success: function(data) {
                    $('#sub_district').html(data);
                }
            });
        });

        $('#sub_district').change(function() {
            var id_tambon = $(this).val();

            $.ajax({
                type: "POST",
                url: "ajax_province.php",
                data: {
                    id: id_tambon,
                    function: 'sub_district'
                },
                success: function(data) {
                    $('#postcode').val(data)
                }
            });

        });
    </script>
</body>

</html>