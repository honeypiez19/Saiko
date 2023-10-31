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
        <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">SHIPPO ASAHI MOULDS(THAILAND)
            CO.,LTD<br>ฟอร์มเบิกของ</h1>
        <div class="row" style="font-size: 20px; margin-top: 40px">
            <div class="col-3">แผนก :</div>
            <div class="col-3">รหัส :</div>
            <div class="col-3">ชื่อ :</div>
            <div class="col-3">นามสกุล :<br></div>
        </div>
        <div class="row">
            <div class="col-3">
                <select class="myform" style="width:250px; height:30px" id="Dept">
                    <option value="" selected disabled>- กรุณาเลือกแผนก -</option>
                    <?php
                    $sql2 = "select DISTINCT Department from User";
                    $query2 = mysqli_query($conn, $sql2);
                    foreach ($query2 as $row) { ?>
                        <option value="<?= $row['Department'] ?>"><?= $row['Department'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-3">
                <select class="myform" style="width:250px; height:30px" id="usercode">
                    <option value="" selected disabled>- กรุณาเลือกรหัสพนักงาน -</option>
                </select>
            </div>
            <div class="col-3">
                <input type="text" class="myform" id="fname" size="27" value="">
                <br><br>
            </div>
            <div class="col-3">
                <input type="text" class="myform" id="lname" size="27" value="">
                <br><br>
            </div>
        </div>
        <div class="row">
            <!-- search box -->
            <div class="row" style="margin-top: 30px;">
                <div class="input-group">
                    <label class="control-label"><b>Search Product Code or Name:</b></label>
                    <div class="col">
                        <input type="search" list="searchlist" class="form-control" autocomplete="off" value="" id="txtsearch" placeholder="type here">

                        <!-- get value for check btn-delete clicked -->
                        <input type="hidden" id="check-btn" value="false">

                        <!-- get value from request number -->
                        <input type="hidden" id="req_no" value="0">
                        <datalist id="searchlist">
                            <?php
                            $sql2 = "SELECT * FROM Stock ";
                            $query2 = mysqli_query($conn, $sql2);
                            foreach ($query2 as $row) { ?>
                                <option value="<?= $row['Product_code'] ?>"><?= $row['Product_name'] ?></option>
                            <?php } ?>
                        </datalist>
                    </div>
                    <div class="col" style="padding-left: 20px">
                        <button class="btn btn-outline-info btn-add">Add</button>
                    </div>
                </div>
            </div>

            <h1 class="heading">รายการเบิก</h1>
            <form id="FormInput">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th style="border-bottom: hidden;">ลำดับที่</th>
                            <th style="border-bottom: hidden;">รหัส</th>
                            <th style="border-bottom: hidden;">รายการ</th>
                            <th style="border-bottom: hidden;">จำนวน</th>
                            <th style="border-bottom: hidden;">หน่วย</th>
                            <th colspan="2">วัตถุประสงค์ในการเบิก</th>
                            <th style="border-bottom: hidden;">ลบ</th>
                        </tr>
                        <tr class="text-center">
                            <th>NO.</th>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>Q'TY</th>
                            <th>UNIT</th>
                            <th>PROD.NO.</th>
                            <th>PART</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- footer -->
                <div id="Divfooter">
                    <div class="row" style="margin-top : 50px; margin-left:2px">ได้ตรวจสอบจำนวน และรายละเอียดต่างๆ เรียบร้อยแล้ว</div>
                    <div class="row" style="margin-top : 30px">
                        <div class="col" style="margin-left : 5px">ผู้เบิก REQUEST NAME : <span id="nameReq"></span>
                        </div>
                        <div class="col-4" style="text-align: left;">ผู้อนุมัติ APPROVED BY :
                        </div>
                    </div>
                    <div class="row" style="margin-top : 20px">
                        <div class="col" style="margin-left : 5px">ผู้จ่ายของ STORE KEEPER :
                        </div>
                        <div class="col-4" style="text-align: left">ผู้รับของ GOODS RECEIVED BY :
                        </div>
                    </div>
                </div>

            </form>
            <div class="row" style="text-align: end; margin-top : 50px; margin-bottom: 50px;">
                <div class="col"><button class="btn btn-outline-success btn-submit" onclick="clickCount()" type="submit">Submit</button></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#Divfooter').hide();

        // get date and set format
        const d = new Date();
        var day_req = moment(d).format('YYMMDD');
        var datenow = d.getDate();
        var hours = d.getHours();
        var minutes = d.getMinutes();
        //count request no.
        function clickCount() {
            if (typeof(Storage) !== "undefined") {
                if (localStorage.clickcount) {
                    //********** WAIT **********
                    if (datenow == 31 && hours == 09 && minutes == 40) {
                        localStorage.clickcount = 0;
                    }
                    localStorage.clickcount = Number(localStorage.clickcount) + 1;
                }
                $('#req_no').val(localStorage.clickcount)
            }
        }

        $(document).ready(function() {

            // ajax department
            $('#Dept').change(function() {
                var id_dept = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "ajax_province.php",
                    data: {
                        id: id_dept,
                        function: 'dept'
                    },
                    success: function(data) {
                        $('#usercode').html(data);
                        $('#fname').val('');
                        $('#lname').val('');
                    }
                });
            });

            // ajax Usercode
            $('#usercode').change(function() {
                var id_code = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "User_ajax_req.php",
                    data: {
                        id: id_code,
                        function: 'code'
                    },
                    success: function(data) {
                        $('#fname').val(data.name);
                        $('#lname').val(data.lname);
                        $('#nameReq').html(data.name);
                    }
                });
            });

            // add clicked
            $('.btn-add').click(function() {
                var productCode = $('#txtsearch').val(); // ดึงค่าที่ป้อนในฟิลด์ #txtsearch และเก็บค่านั้นไว้ในตัวแปร productCodeOrName
                addRowToTable(productCode); // เรียกฟังก์ชัน addRowToTable() และส่งค่า productCodeOrName เข้าไปในฟังก์ชันจะสร้างแถวใหม่เมื่อกดปุ่ม Addrow
                $('#Divfooter').show();
                CodeCheck(productCode);
            });

            // check duplicate row
            function CodeCheck(productCode) {
                var txt = productCode; // Product_code from search box
                var table = $('#myTable tbody');
                var row = table.find("tr");
                var no = table.find("tr:last").find("td:eq(0)").html();

                if (no >= 2) {
                    for (i = 0; i < no; i++) {
                        var code = $("#Code" + [i + 1]).html(); // Product_code of row
                        if (txt == code) {
                            Swal.fire({
                                title: 'Duplicate Row',
                                text: 'เลือกรายการนี้ไปแล้ว',
                                icon: 'error',
                            });
                            table.find("tr:last").remove(); // remove duplicate row
                        }
                    }
                }
            }

            $(window).on("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    $('.btn-submit').click();
                }
            });

            // submit clicked
            $('.btn-submit').click(function() {
                var table = $('#myTable tbody'); // find table
                var row = table.find("tr");
                var no = table.find("tr:last").find("td:eq(0)").html(); // find index and get index
                var code = "";
                var name = "";
                var qty = "";
                var unit = "";
                var prodNo = "";
                var part = "";
                let join = "";
                var arryProduct = [];
                const elements = document.getElementsByName("row-btn"); // get elements by name = row-btn (in td[7]) 
                var n = "";
                var req_no = $('#req_no').val();
                var fulldate = day_req.concat(req_no);
                var fname = $('#fname').val();
                var lname = $('#lname').val();

                if (fname.length == 0) {
                    Swal.fire({
                        title: '',
                        text: 'ชื่อผู้เบิกห้ามเป็นค่าว่าง',
                        icon: 'error',
                    });
                } else {
                    // loop get value of row by check index and loop
                    for (i = 0; i < no; i++) {

                        // get value from td[7] in row
                        n = elements[i].value;

                        // get value in td[1] - td[7] by id
                        code = $("#Code" + [n]).html();
                        name = $("#productName" + [n]).html();
                        qty = $("#qty" + [n]).val();
                        unit = $("#unit" + [n]).val();
                        prodNo = $("#prodNo" + [n]).val();
                        part = $("#part" + [n]).val();

                        // join all value of column in 1 row
                        join += [code, name, qty, unit, prodNo, part];

                        // push object to array for insert to database
                        arryProduct.push({
                            PCode: code,
                            Pname: name,
                            Pqty: qty,
                            Punit: unit,
                            Pprod: prodNo,
                            Ppart: part,
                        })
                    }

                    let len = arryProduct.length; // check length of array
                    //$("#colresult").val(len);

                    // loop for get object from array
                    for (h = 0; h < len; h++) {
                        P_code = arryProduct[h].PCode;
                        P_name = arryProduct[h].Pname;
                        P_qty = arryProduct[h].Pqty;
                        P_unit = arryProduct[h].Punit;
                        P_prodNo = arryProduct[h].Pprod;
                        P_part = arryProduct[h].Ppart;

                        // insert to database
                        $.ajax({
                            type: "post",
                            url: "User_ajax_req.php",
                            data: {
                                dateReq: fulldate,
                                Name_req: fname,
                                P_Code: P_code,
                                P_Name: P_name,
                                P_Qty: P_qty,
                                P_Unit: P_unit,
                                P_ProdNo: P_prodNo,
                                P_Part: P_part,
                                function: 'submit'
                            },
                            success: function(data) {
                                if (data.status == 1) {
                                    Swal.fire({
                                        title: '',
                                        text: 'Data updated successfully!',
                                        icon: 'success',
                                    });
                                    row.remove();
                                    $('#usercode').html('<option value="" selected disabled>- กรุณาเลือกรหัสพนักงาน -</option>');
                                    $('#fname').val(' ');
                                    $('#lname').val(' ');
                                } else {
                                    Swal.fire({
                                        title: '',
                                        text: data.message,
                                        icon: 'error',
                                    });
                                }
                            }
                        });
                    }

                }
            });
        });

        function checkMax(event) {
            const {
                value,
                max
            } = event.target;

            if (max - value == 0) {
                alert("สินค้าในคลังเหลือ " + max);
            }
        }

        // add row of selected product 
        function addRowToTable(productCode) {
            var check = $('#check-btn').val(); // get value from id check-btn
            var tbody = $('#myTable tbody'); // เลือก tbody ของตาราง #myTable
            var newRow = $('<tr class="text-center"></tr>'); // สร้างแถวใหม่
            var indx = "";
            if (check === "true") {
                indx = tbody.find('tr').length + 2;
            } else {
                indx = tbody.find('tr').length + 1;
            }
            var indexColumn = '<td>' + (tbody.find('tr').length + 1) + '</td>'; //สร้าง cell สำหรับคอลัมน์ No. ใช้ค่าลำดับของแถวใน tbody ปัจจุบัน +1
            var productColumn = '<td id="Code' + (indx) + '"></td>';
            var descriptionColumn = '<td style="width:20%" id="productName' + (indx) + '"></td>';
            var qtyColumn = '<td><input class="myform" name="Qty" type="number" min="1" max="" oninput="checkMax(event)" size="10" id="qty' + (indx) + '"></td>'; // ใช้ที่กรอกเข้ามา มาแสดง
            var unitColumn = '<td><input class="myform" type="text" size="10" id="unit' + (indx) + '"></td>'; // ใช้ที่กรอกเข้ามา มาแสดง
            var prodNoColumn = '<td><input class="myform" type="text" id="prodNo' + (indx) + '"></td>'; // ใช้ที่กรอกเข้ามา มาแสดง
            var partColumn = '<td><input class="myform" type="text" id="part' + (indx) + '"></td>'; // ใช้ที่กรอกเข้ามา มาแสดง
            var deleteColumn = '<td><button value="' + indx + '" class="btn btn-outline-danger btn-delete" name="row-btn">Delete</button></td>'; // ปุ่มลบ

            // เพิ่มคอลัมน์ทั้งหมดที่สร้างขึ้นไปยังแถวใหม่
            newRow.append(indexColumn, productColumn, descriptionColumn, qtyColumn, unitColumn, prodNoColumn, partColumn,
                deleteColumn);
            tbody.append(newRow); // เพิ่มแถวใหม่ลงใน tbody ของตาราง
            $('#txtsearch').val('') // Reset ค่าที่กรอกใหม่

            // เมื่อกดปุ่ม Delete ในแถวใหม่ถูกคลิก จะลบแถวนั้นออกและเรียกใช้ฟังก์ชัน updateRowIndexes() เพื่ออัปเดตลำดับของแถวในตาราง
            newRow.find('.btn-delete').click(function() {
                newRow.remove();
                updateRowIndexes();
                $('#check-btn').val('true'); // reset value of id check-btn is mean btn clicked
            });

            // call name from database
            $.ajax({
                type: "POST",
                url: "User_ajax_req.php",
                data: {
                    id: productCode,
                    function: 'search'
                },
                success: function(data) {
                    newRow.find('td:eq(1)').html(data.ProductCode); // find column 1 in row and show code
                    newRow.find('td:eq(2)').html(data.ProductName); // find column 2 in row and show name
                    newRow.find('td:eq(3)').find('[name="Qty"]').attr("max", data.max_qty); // find column 3 in row find input name="Qty" and set attribute = total Qty in Store
                }
            });
        }

        function updateRowIndexes() {
            $('#myTable tbody tr').each(function(index) { //เลือกทุกแถว <tr> ใน tbody
                $(this).find('td:first').text(index + 1); // แถวปัจจุบันที่ถูกลูปฟังก์ชัน find('td:first') ค้นหาคอลัมน์แรก <td> ในแถวปัจจุบัน
            });
        }
    </script>
</body>

</html>