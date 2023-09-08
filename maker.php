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
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">ข้อมูลผู้จำหน่าย</h1>
        <!-- search box -->
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <div class="row" style="margin-top: 20px;">
                <div class="input-group">
                    <div class="col-1" style="font-size: 20px;">
                        TAX ID :
                    </div>
                    <div class="col-3">
                        <input name="txtKeyword" type="text" class="form-control" id="txtKeyword" placeholder="Type here">
                    </div>
                    <div class="col" style="padding-left:20px">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- end search box -->
        <!-- form -->
        <form method="post" action="">
            <?php $Product_code = $Product_name = $Qty = $Unit = $Unit_price = $Residual_value = $Min = $Max = ""; ?>
            <div class="row" style="font-size: 20px; margin-top: 40px">
                <div class="col-1">
                    ชื่อบริษัท :
                </div>
                <div class="col-3">
                    <input type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                    <br><br>
                </div>
                <div class="col-1">
                    สาขา :
                </div>
                <div class="col-3">
                    <input type="text" name="Qty" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    เลขที่ :
                </div>
                <div class="col-1">
                    <input type="text" name="Product_name" size="2" value="<?php echo $Product_name; ?>">
                    <br><br>
                </div>
                <div class="col-2">
                    <label>หมู่ที่ :</label>&emsp;&emsp;
                    <input type="text" name="Product_name" size="2" value="<?php echo $Product_name; ?>">
                    <br><br>
                </div>
                <div class="col-1">
                    อาคาร :
                </div>
                <div class="col-3">
                    <input type="text" name="Qty" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col">
                    ชั้น :
                </div>
                <div class="col-3">
                    <input type="text" name="Product_name" size="8" value="<?php echo $Product_name; ?>">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-2">
                    <label>ห้อง :</label>&emsp;&emsp;&emsp;
                    <input type="text" name="Qty" size="2" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col-2">
                    <label>ซอย :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="2" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>ถนน :</label>&emsp;&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>

                <div class="col-1">
                    จังหวัด :
                </div>
                <div class="col-3">
                <input type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    อำเภอ :
                </div>
                <div class="col-3">
                <input type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                    <br><br>
                </div>
                <div class="col-1">
                    ตำบล :
                </div>
                <div class="col-3">
                <input type="text" name="Product_code" value="<?php echo $Product_code; ?>">
                    <br>
                </div>
                <div class="col-4" style="padding:0px;">
                    &emsp;<label>รหัสไปรษณีย์ :</label>&emsp;&emsp;
                    <input type="text" size="4" name="postcode" id="postcode">
                    <br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>แฟ็กซ์ :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="22" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 1 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 2 :</label>&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>เบอร์โทร 3 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 1 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 2 :</label>&emsp;&emsp;
                    <input type="text" name="Qty" size="20" value="<?php echo $Qty; ?>">
                    <br><br>
                </div>
            </div>
        </form>
        <!-- end table product -->
    </div>
</body>

</html>