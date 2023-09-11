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
    <div class="container">
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">แก้ไขข้อมูลผู้จำหน่าย</h1>
        <!-- form maker-->
        <form class="form">
            <!-- search box -->
            <div class="row" style="margin-top: 20px; font-size: 20px;">
                <div class="input-group">
                    <div class="col-1">
                        TAX ID :
                    </div>
                    <div class="col-3">
                        <select style="width:250px; height:30px" id="taxid">
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

            <div class="row" style="font-size: 20px; margin-top: 40px">
                <div class="col-1">
                    ชื่อบริษัท :
                </div>
                <div class="col-3">
                    <input type="text" id="CompanyName" required>
                    <span class="error">*</span>
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
                    <input type="text" id="AddrNo" size="2" required>
                    <span class="error">*</span>
                    <br><br>
                </div>
                <div class="col-2">
                    <label for="AddrNo">หมู่ที่ :</label>&emsp;&emsp;
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
                    <input type="text" id="Floor" size="8">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-2">
                    <label for="Room">ห้อง :</label>&emsp;&emsp;&emsp;
                    <input type="text" id="Room" size="2">
                    <br><br>
                </div>
                <div class="col-2">
                    <label for="Soi">ซอย :</label>&emsp;&emsp;
                    <input type="text" id="Soi" size="2">
                    <br><br>
                </div>
                <div class="col-4">
                    <label for="Road">ถนน :</label>&emsp;&emsp;&emsp;
                    <input type="text" id="Road" size="20">
                    <br><br>
                </div>

                <div class="col-1">
                    จังหวัด :
                </div>
                <div class="col-3">
                    <select style="width:250px" id="province" required>
                        <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                        <?php
                        $sql = "select DISTINCT Province from Province";
                        $query = mysqli_query($conn, $sql);
                        foreach ($query as $r) { ?>
                            <option value="<?= $r['Province'] ?>"><?= $r['Province'] ?></option>
                        <?php } ?>
                    </select>
                    <span class="error">*</span>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-1">
                    อำเภอ :
                </div>
                <div class="col-3">
                    <select style="width:250px" id="district" required>
                    </select>
                    <span class="error">*</span>
                    <br><br>
                </div>
                <div class="col-1">
                    ตำบล :
                </div>
                <div class="col-3">
                    <select style="width:250px" id="sub_district" required>
                    </select>
                    <span class="error">*</span>
                    <br>
                </div>
                <div class="col-4" style="padding:0px;">
                    &emsp;<label for="postcode">รหัสไปรษณีย์ :</label>&emsp;&emsp;
                    <input type="text" size="4" id="postcode" required>
                    <span class="error">*</span>
                    <br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label for="Fax">แฟ็กซ์ :</label>&emsp;&emsp;
                    <input type="text" id="Fax" size="22">
                    <br><br>
                </div>
                <div class="col-4">
                    <label for="TelOne">เบอร์โทร 1 :</label>&emsp;&emsp;
                    <input type="text" id="TelOne" size="20" required>
                    <span class="error">*</span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label for="TelTwo">เบอร์โทร 2 :</label>&emsp;
                    <input type="text" id="TelTwo" size="20">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col-4">
                    <label for="TelThree">เบอร์โทร 3 :</label>&emsp;&emsp;
                    <input type="text" id="TelThree" size="20">
                    <br><br>
                </div>
                <div class="col-4">
                    <label for="MailOne">อีเมล 1 :</label>&emsp;&emsp;
                    <input type="text" id="MailOne" size="20" required>
                    <span class="error">*</span>
                    <br><br>
                </div>
                <div class="col-4">
                    <label for="MailTwo">อีเมล 2 :</label>&emsp;&emsp;
                    <input type="text" id="MailTwo" size="20">
                    <br><br>
                </div>
            </div>
            <div class="row" style="font-size: 20px;">
                <div class="col" style="margin-top:20px">
                    <!-- <input type="submit" id="submit" class="btn btn-outline-success btn-lg" value="บันทึก"> -->
                    <button type="button" class="btn btn-outline-success btn-lg btn-submit-edit">บันทึก</button>
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
                    $('#sub_district').html(`<option value='${data.sub_district}'> ${data.sub_district}</option>`);
                    $('#district').html(`<option value='${data.district}'> ${data.district}</option>`);
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

        // update data of maker
        $(document).ready(function() {
            $(".btn-submit-edit").click(function() {
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
                            function: 'submit-update'
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: '',
                                    text: 'Data updated successfully!',
                                    icon: 'success',
                                });
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