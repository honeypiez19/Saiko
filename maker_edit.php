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
        $TaxID = $Company_name = $Major_name = $Addr_no = $Moo_no = $Building = $Floor = $Room = $Soi = $Road =
            $Sub_district = $District = $Province = $Postcode = $Fax = $Tel_one = $Tel_two = $Tel_three = $Email_one = $Email_two = "";
        function altmsg()
        {
            echo "<script>
            Swal.fire({
                title: '',
                text: 'Please enter data!',
                icon: 'error',
            });
        </script>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                empty($_POST["TaxID"]) && empty($_POST["Company_name"]) && empty($_POST["Major_name"]) && empty($_POST["Addr_no"]) &&
                empty($_POST["Moo_no"]) && empty($_POST["Building"]) && empty($_POST["Floor"]) && empty($_POST["Room"]) &&
                empty($_POST["Soi"]) && empty($_POST["Road"]) && empty($_POST["Sub_district"]) && empty($_POST["District"]) &&
                empty($_POST["Province"]) && empty($_POST["Postcode"]) && empty($_POST["Fax"]) && empty($_POST["Tel_one"]) &&
                empty($_POST["Tel_two"]) && empty($_POST["Tel_three"]) && empty($_POST["Email_one"]) && empty($_POST["Email_two"])
            ) {
                altmsg();
                $nameErr = "*";
            }
        }
        ?>
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">แก้ไขข้อมูลผู้จำหน่าย</h1>
        <!-- search box -->
        <form method="post" action="">
            <div class="row" style="margin-top: 20px;">
                <div class="input-group">
                    <div class="col-1" style="font-size: 20px;">
                        TAX ID :
                    </div>
                    <div class="col-3">
                        <select style="width:250px" id="taxid">
                            <option value="" selected disabled>-กรุณาเลือก TAX ID-</option>
                            <?php
                            $sql2 = "select * from Maker";
                            $query2 = mysqli_query($conn, $sql2);
                            foreach ($query2 as $row) { ?>
                                <option value="<?= $row['TaxID'] ?>"><?= $row['TaxID'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- end search box -->
            <!-- form -->
            <div class="row" style="font-size: 20px; margin-top: 40px">
                <div class="col-1">
                    ชื่อบริษัท :
                </div>
                <div class="col-3">
                    <input type="text" id="CompanyName">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-1">
                    สาขา :
                </div>
                <div class="col-3">
                    <input type="text" id="MajorName">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    เลขที่ :
                </div>
                <div class="col-1">
                    <input type="text" id="AddrNo" size="2">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-2">
                    <label>หมู่ที่ :</label>&emsp;&emsp;
                    <input type="text" id="Moo" size="2">
                    <br><br>
                </div>
                <div class="col-1">
                    อาคาร :
                </div>
                <div class="col-3">
                    <input type="text" id="Building">
                    <br><br>
                </div>
                <div class="col">
                    ชั้น :
                </div>
                <div class="col-3">
                    <input type="text" id="Floor" size="8" >
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-2">
                    <label>ห้อง :</label>&emsp;&emsp;&emsp;
                    <input type="text" id="Room" size="2" value="<?php echo $Room; ?>">
                    <br><br>
                </div>
                <div class="col-2">
                    <label>ซอย :</label>&emsp;&emsp;
                    <input type="text" id="Soi" size="2" value="<?php echo $Soi; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>ถนน :</label>&emsp;&emsp;&emsp;
                    <input type="text" id="Road" size="20" value="<?php echo $Road; ?>">
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
                    <select style="width:250px" name="district" id="district">
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
                    <input type="text" size="4" id="postcode">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>แฟ็กซ์ :</label>&emsp;&emsp;
                    <input type="text" id="Fax" size="22" value="<?php echo $Fax; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 1 :</label>&emsp;&emsp;
                    <input type="text" id="TelOne" size="20">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 2 :</label>&emsp;
                    <input type="text" id="TelTwo" size="20" value="<?php echo $Tel_two; ?>">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>เบอร์โทร 3 :</label>&emsp;&emsp;
                    <input type="text" id="TelThree" size="20" value="<?php echo $Tel_three; ?>">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 1 :</label>&emsp;&emsp;
                    <input type="text" id="MailOne" size="20" value="<?php echo $Email_one; ?>">
                    <span class="error"> <?php echo $nameErr; ?></span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 2 :</label>&emsp;&emsp;
                    <input type="text" id="MailTwo" size="20" value="<?php echo $Email_two; ?>">
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
                url: "ajax_maker.php",
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
                url: "ajax_maker.php",
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
                url: "ajax_maker.php",
                data: {
                    id: id_tambon,
                    function: 'sub_district'
                },
                success: function(data) {
                    $('#postcode').val(data)
                }
            });
        });

        $('#taxid').change(function() {
            var id_tax = $(this).val();

            $.ajax({
                type: "POST",
                url: "ajax_maker.php",
                data: {
                    id: id_tax,
                    function: 'taxid'
                },
                success: function(data) {
                    $('#CompanyName').val(data.CompanyName);
                    $('#MajorName').val(data.MajorName);
                    $('#AddrNo').val(data.AddrNo);
                    $('#Moo').val(data.Moo);
                    $('#Building').val(data.Building);
                    $('#Floor').val(data.Floor);
                    $('#Room').val(data.Room);
                    $('#Soi').val(data.Soi);
                    $('#Road').val(data.Road);
                    $('#sub_district').val(data.sub_district);
                    $('#district').val(data.district);
                    $('#province').val(data.province);
                    $('#postcode').val(data.postcode);
                    $('#Fax').val(data.Fax);
                    $('#TelOne').val(data.TelOne);
                    $('#TelTwo').val(data.TelTwo);
                    $('#TelThree').val(data.TelThree);
                    $('#MailOne').val(data.MailOne);
                    $('#MailTwo').val(data.MailTwo);
                }
            });
        });
    </script>
</body>

</html>