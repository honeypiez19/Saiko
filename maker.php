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
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">ข้อมูลผู้จำหน่าย</h1>
        <!-- form maker-->
        <form class="form" style="margin-left: 14px;">
            <!-- search box -->
            <div class="row" style="margin-top: 20px; font-size: 20px;">
                <div class="input-group">
                    <div class="col-1">
                        TAX ID :
                    </div>
                    <div class="col-3">
                        <select class="myform" style="width:250px; height:40px" id="taxid">
                            <option value="" selected disabled>- กรุณาเลือก TAX ID -</option>
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
            <!-- div maker -->
            <div class="row" style="font-size: 20px; margin-top: 40px">
                <div class="col-1">
                    ชื่อบริษัท :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="CompanyName">
                    <br><br>
                </div>
                <div class="col-1">
                    สาขา :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="MajorName">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    เลขที่ :
                </div>
                <div class="col-1">
                    <input class="myform" type="text" id="AddrNo" size="2">
                    <br><br>
                </div>
                <div class="col-2">
                    <label>หมู่ที่ :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="Moo" size="2">
                    <br><br>
                </div>
                <div class="col-1">
                    อาคาร :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="Building">
                    <br><br>
                </div>
                <div class="col">
                    ชั้น :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="Floor" size="8">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-2">
                    <label>ห้อง :</label>&emsp;&emsp;&emsp;
                    <input class="myform" type="text" id="Room" size="1">
                    <br><br>
                </div>
                <div class="col-2">
                    <label>ซอย :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="Soi" size="2">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>ถนน :</label>&emsp;&emsp;&emsp;
                    <input class="myform" type="text" id="Road" size="20">
                    <br><br>
                </div>
                <div class="col-1">
                    จังหวัด :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="province">
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    อำเภอ :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="district"></input>
                    <br><br>
                </div>
                <div class="col-1">
                    ตำบล :
                </div>
                <div class="col-3">
                    <input class="myform" type="text" id="sub_district"></input>
                    <br>
                </div>
                <div class="col-4" style="padding:0px;">
                    &emsp;<label>รหัสไปรษณีย์ :</label>&emsp;&emsp;
                    <input class="myform" type="text" size="4" id="postcode">
                    <br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>แฟ็กซ์ :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="Fax" size="22">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 1 :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="TelOne" size="20">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>เบอร์โทร 2 :</label>&emsp;
                    <input class="myform" type="text" id="TelTwo" size="20">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label>เบอร์โทร 3 :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="TelThree" size="20">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 1 :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="MailOne" size="20">
                    <br><br>
                </div>
                <div class="col-4">
                    <label>อีเมล 2 :</label>&emsp;&emsp;
                    <input class="myform" type="text" id="MailTwo" size="20">
                    <br><br>
                </div>
            </div>
        </form>
        <!-- end div maker -->
    </div>
    <script type="text/javascript">
        // show data of maker
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