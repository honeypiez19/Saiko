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
                <div class="col-4">
                    TAX ID :&emsp;&emsp;
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
            <!-- end search box -->

            <!-- all input -->
            <div class="row" style="font-size: 20px; margin-top: 40px">
                <div class="col-4">ชื่อบริษัท :&emsp;&nbsp;
                    <input class="myform" type="text" id="CompanyName">
                </div>
                <div class="col-4">สาขา :&emsp;&nbsp;
                    <input class="myform" type="text" id="MajorName">
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-2">เลขที่ :&emsp;
                    <input class="myform" type="text" id="AddrNo" size="1">
                </div>
                <div class="col-2">หมู่ที่ :&emsp;
                    <input class="myform" type="text" id="Moo" size="2">
                </div>
                <div class="col-4">อาคาร :&emsp;
                    <input class="myform" type="text" id="Building">
                </div>
                <div class="col-3">ชั้น :&emsp;
                    <input class="myform" type="text" id="Floor" size="8">
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-2">ห้อง :&emsp;&nbsp;&nbsp;
                    <input class="myform" type="text" id="Room" size="1">
                </div>
                <div class="col-2">ซอย :&emsp;
                    <input class="myform" type="text" id="Soi" size="2">
                </div>
                <div class="col-4">ถนน :&emsp;&nbsp;&nbsp;&nbsp;
                    <input class="myform" type="text" id="Road" size="20">
                </div>
                <div class="col-4">ตำบล :&emsp;&nbsp;
                    <input class="myform" type="text" id="sub_district" size="24">
                </div>

            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-4">อำเภอ :&emsp;
                    <input class="myform" type="text" id="district" size="20">
                </div>
                <div class="col-4">จังหวัด :&nbsp;&nbsp;
                    <input class="myform" type="text" id="province" size="24">
                </div>
                <div class="col-4">รหัสไปรษณีย์ :&emsp;
                    <input class="myform" type="text" size="18" id="postcode">
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-4">แฟ็กซ์ :&nbsp;&nbsp;&nbsp;
                    <input class="myform" type="text" id="Fax" size="24">
                </div>
                <div class="col-4">เบอร์โทร 1 :&emsp;
                    <input class="myform" type="text" id="TelOne" size="20">
                </div>
                <div class="col-4">เบอร์โทร 2 :&emsp;
                    <input class="myform" type="text" id="TelTwo" size="20">
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px; margin-bottom:40px">
                <div class="col-4">เบอร์โทร 3 :&emsp;
                    <input class="myform" type="text" id="TelThree" size="20">
                </div>
                <div class="col-4">อีเมล 1 :&emsp;
                    <input class="myform" type="text" id="MailOne" size="23">
                </div>
                <div class="col-4">อีเมล 2 :&emsp;
                    <input class="myform" type="text" id="MailTwo" size="23">
                </div>
            </div>
            <!-- end input -->
        </form>
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