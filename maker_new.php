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
</head>

<body>
    <?php include 'header_nav.php' ?>
    <div class="container myform" style="margin-top: 50px;">
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">สร้างข้อมูลผู้จำหน่าย</h1>
        <!-- form maker-->
        <form class="form" style="margin-left: 14px;">
            <!-- search box -->
            <div class="row" style="margin-top: 20px; font-size: 20px;">
                <div class="col-4">
                    TAX ID :&emsp;&emsp;
                    <input class="myform" type="text" id="taxid" required>
                    <span class="error">*</span>
                </div>
            </div>
            <!-- end search box -->

            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-4">ชื่อบริษัท :&emsp;
                    <input class="myform" type="text" id="CompanyName" required>
                    <span class="error">*</span>
                </div>
                <div class="col-4">สาขา :&emsp;&nbsp;
                    <input class="myform" type="text" id="MajorName">
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-2">เลขที่ :&emsp;
                    <input class="myform" type="text" id="AddrNo" size="1" required>
                    <span class="error">*</span>
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
                <div class="col-4">จังหวัด :&emsp;
                    <select class="myform" style="width:290px" id="province" required>
                        <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                        <?php
                        $districtt = "";
                        $sql = "select DISTINCT Province from Province";
                        $query = mysqli_query($conn, $sql);
                        foreach ($query as $r) { ?>
                            <option value="<?= $r['Province'] ?>"><?= $r['Province'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="error">*</span>
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-4">อำเภอ :&emsp;
                    <select class="myform" style="width:290px" id="district" required>
                        <option value="<?= $r['District'] ?>"><?= $districtt ?></option>
                    </select>
                    <span class="error">*</span>
                </div>
                <div class="col-4">ตำบล :&emsp;&nbsp;
                    <select class="myform" style="width:250px" id="sub_district" required>
                    </select>
                    <span class="error">*</span>
                </div>
                <div class="col-4">รหัสไปรษณีย์ :&emsp;
                    <input class="myform" type="text" size="18" id="postcode" required>
                    <span class="error">*</span>
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-4">แฟ็กซ์ :&emsp;
                    <input class="myform" type="text" id="Fax" size="24">
                </div>
                <div class="col-4">เบอร์โทร 1 :&emsp;
                    <input class="myform" type="text" id="TelOne" size="20" required>
                    <span class="error">*</span>
                </div>
                <div class="col-4">เบอร์โทร 2 :&emsp;
                    <input class="myform" type="text" id="TelTwo" size="20">
                </div>
            </div>
            <div class="row" style="font-size: 20px; margin-top: 30px">
                <div class="col-4">เบอร์โทร 3 :&emsp;
                    <input class="myform" type="text" id="TelThree" size="20">
                </div>
                <div class="col-4">อีเมล 1 :&emsp;
                    <input class="myform" type="text" id="MailOne" size="23" required>
                    <span class="error">*</span>
                </div>
                <div class="col-4">อีเมล 2 :&emsp;
                    <input class="myform" type="text" id="MailTwo" size="23">
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col" style="margin-top:40px; margin-bottom:30px">
                    <button type="button" class="btn btn-outline-success btn-lg btn-submit-new">บันทึก</button>&emsp;&emsp;
                    <input type="reset" name="reset" class="btn btn-outline-warning btn-lg btn-reset" value="Reset">
                </div>
            </div>
        </form>
        <!-- end form maker -->
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

        // reset value of district
        $('.btn-reset').click(function() {
            $('#sub_district').html(' ');
            $('#district').html(' ');
        });

        // update data of maker
        $(document).ready(function() {
            $(".btn-submit-new").click(function() {
                //check empty fields
                let valid = true;
                $('[required]').each(function() {
                    if ($(this).is(':invalid') || !$(this).val()) valid = false;
                })
                if (!valid) {
                    Swal.fire({
                        title: '',
                        text: 'Please fill all data!',
                        icon: 'error',
                    });
                } else {
                    var button = $(this);
                    var form = button.closest("form");
                    var tax = form.find("#taxid").val();
                    var ComName = form.find("#CompanyName").val();
                    var Major = form.find("#MajorName").val();
                    var Addr = form.find("#AddrNo").val();
                    var Moo = form.find("#Moo").val();
                    var Building = form.find("#Building").val();
                    var Floor = form.find("#Floor").val();
                    var Room = form.find("#Room").val();
                    var Soi = form.find("#Soi").val();
                    var Road = form.find("#Road").val();
                    var SubDis = form.find("#sub_district").val();
                    var District = form.find("#district").val();
                    var Province = form.find("#province").val();
                    var Postcode = form.find("#postcode").val();
                    var Fax = form.find("#Fax").val();
                    var TelOne = form.find("#TelOne").val();
                    var TelTwo = form.find("#TelTwo").val();
                    var TelThree = form.find("#TelThree").val();
                    var MailOne = form.find("#MailOne").val();
                    var MailTwo = form.find("#MailTwo").val();

                    $.ajax({
                        type: "post",
                        url: "ajax_maker.php",
                        data: {
                            TaxID: tax,
                            Company_name: ComName,
                            MajorName: Major,
                            Addr: Addr,
                            Moo: Moo,
                            Building: Building,
                            Floor: Floor,
                            Room: Room,
                            Soi: Soi,
                            Road: Road,
                            Sub_district: SubDis,
                            District: District,
                            Province: Province,
                            Postcode: Postcode,
                            Fax: Fax,
                            TelOne: TelOne,
                            TelTwo: TelTwo,
                            TelThree: TelThree,
                            MailOne: MailOne,
                            MailTwo: MailTwo,
                            function: 'submit-new'
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: '',
                                    text: 'Data updated successfully!',
                                    icon: 'success',
                                });
                                $('.btn-reset').click();
                            } else {
                                Swal.fire({
                                    title: '',
                                    text: data.message,
                                    icon: 'error',
                                });
                            }
                        }
                    });
                };

            });
        });
    </script>
</body>

</html>