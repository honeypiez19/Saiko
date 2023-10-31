<!-- connect database, searchbox and navbar menu -->
<?php include 'searchbox.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/bootstrap_531.min.js"></script>
    <script src="js/jquery_370.min.js"></script>
    <script src="js/moment.min.js"></script>
    <link href="css/select2_410.min.css" rel="stylesheet" />
    <script src="js/select2_410.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="row justify-content-end">
        <div class="col-2"><a type="button" id="btn-po" class="btn btn-outline-info btn-lg" data-bs-toggle="modal" data-bs-target="#ModalPO">เปิด PO</a></div>
    </div>

    <form id="products" class="form-check">
        <div class="container">

            <h1 class="heading">รายการสินค้า</h1>
            <table class="table" id="myTable">
                <thead>
                    <tr class="text-center">
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>หน่วย</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>มูลค่าคงเหลือ</th>
                        <th>จำนวนขั้นต่ำ</th>
                    </tr>
                </thead>
                <tbody>
                    <form>
                        <!-- connect database -->
                        <?php
                        while ($row = $result->fetch_assoc()) :
                            $purchase = $row['Max'] - $row['Qty'];
                            if ($row['Qty'] < $row['Min']) {
                                echo "<tr class='align-middle'>
                        <td> " . $row['Product_code'] . "</td>
                        <td> " . $row['Product_name'] . "</td>
                        <td class='text-center table-danger'>" . $row['Qty'] . "</td>
                        <td class='text-center'> " . $row['Unit'] . "</td>
                        <td class='text-end'> " . $row['Unit_price'] . "</td>
                        <td class='text-end'> " . $row['Residual_value'] . "</td>
                        <td class='text-center'> " . $row['Min'] . "</td>
                    </tr> ";
                            } else {
                                echo "<tr class='align-middle'>
                        <td> " . $row['Product_code'] . "</td>
                        <td> " . $row['Product_name'] . "</td>
                        <td class='text-center'> " . $row['Qty'] . "</td>
                        <td class='text-center'> " . $row['Unit'] . "</td>
                        <td class='text-end'> " . $row['Unit_price'] . "</td>
                        <td class='text-end'> " . $row['Residual_value'] . "</td>
                        <td class='text-center'> " . $row['Min'] . "</td>
                    </tr> ";
                            }
                        ?>
                        <?php endwhile ?>
                        <?php $conn->close(); ?>
                        <!-- end connect database -->
                    </form>
                </tbody>
            </table>
            <!-- end table product -->
            <div class="modal fade" id="ModalPO" data-bs-backdrop="static">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- head modal -->
                        <div class="modal-header">
                            <h4 class="modal-title">เลือกรายการที่ต้องการเปิด P.O.</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <!-- table show product in modal -->
                            <table style="width:100%" id="headPO">
                                <thead>
                                    <tr style="vertical-align: text-top;">
                                        <td style="padding-bottom: 15px; width:15%">เลือกผู้จำหน่าย :</td>
                                        <td style="padding-bottom: 15px;">
                                            <select id="selectMaker" style="width:250px;" required>
                                                <option value="" selected disabled>- กรุณาเลือกผู้จำหน่าย -</option>
                                                <?php include 'connect.php';
                                                $sql2 = "SELECT DISTINCT TaxID, Company_name FROM Orders ";
                                                $query2 = mysqli_query($conn, $sql2);
                                                foreach ($query2 as $row) { ?>
                                                    <option value="<?= $row['TaxID'] ?>"><?= $row['TaxID'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="error">*</span>
                                        </td>
                                        <td>&emsp;&emsp;</td>
                                        <td>เลขที่ใบสั่งซื้อ :</td>
                                        <td>
                                            <input class="myform" type="text" id="po_no" readonly>
                                            <input class="myform" type="text" id="ds" readonly>
                                            <!-- <button type="button" class="btn btn-outline-warning btn-sm" id="ResetPONo">Reset P.O.</button> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 15px;" colspan="5">ชื่อบริษัท : <span id="company_name"></span> <br>ที่อยู่ : <span id="addr"></span>
                                            <input type="hidden" id="mail1"> <input type="hidden" id="mail2">
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-bordered" style="width:100%" id="showProduct">
                                <!-- head table -->
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 9%;"><input style="width:25px; height:25px; vertical-align:top;" type="checkbox" id="allcheck">
                                            <lable for="allcheck">&nbsp;&nbsp;เลือก</label>
                                        </th>
                                        <th style="width: 7%;">ลำดับที่</th>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>หน่วย</th>
                                        <th>ราคาต่อหน่วย</th>
                                    </tr>
                                </thead>
                                <!-- details of product -->
                                <tbody id="TableProduct"></tbody>
                            </table>
                        </div>
                        <!-- footer modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-submit" id="submit" disabled>บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#selectMaker').select2({
                dropdownParent: $('#ModalPO')
            });

            $('#selectMaker').change(function() {
                var id_maker = $(this).val();
                $('#allcheck').prop('checked', false);
                $('#allcheck').removeProp('checked');

                $.ajax({
                    type: "post",
                    url: "ajax_PO.php",
                    data: {
                        maker: id_maker,
                        function: 'maker'
                    },
                    success: function(data) {
                        $('#company_name').html(data.name);
                        $('#addr').html(data.addr);
                        $('#mail1').val(data.mail1);
                        $('#mail2').val(data.mail2);
                    }
                });

                var master_min = [];
                $.ajax({
                    type: "post",
                    url: "ajax_PO.php",
                    data: {
                        maker: id_maker,
                        function: 'master'
                    },
                    success: function(data) {
                        for (j in data) {
                            master_min.push(data[j]);
                        }
                        Min_Details(master_min);
                    }
                });

                function Min_Details(master_min) {
                    let len = master_min.length;
                    // check row before row of detail and remove
                    var modal_body = document.querySelectorAll('#TableProduct tr');
                    if (modal_body.length != len) {
                        for (var i = 1; i <= modal_body.length; i++) {
                            $('#TableProduct tr:first').remove();
                        }
                    }

                    // loop object
                    for (let q = 0; q < len; q++) {
                        var body = $('#showProduct tbody');
                        var row = $('<tr class="align-start" style="font-size: 16px;"></tr>');
                        var indx = q + 1;
                        var checkboxColumn = '<td class="text-center"><lable for="product"></label><input style="width:20px; height:20px;" type="checkbox" class="Cbxproduct" id="' + indx + '" value="' + master_min[q] + '"></td>'
                        var indexColumn = '<td class="text-center" id="col' + indx + '">' + indx + '</td>';
                        var CodeColumn = '<td class="text-center" id="code' + indx + '">' + master_min[q].code + '</td>';
                        var NameColumn = '<td class="text-start" id="name' + indx + '">' + master_min[q].name + '</td>';
                        var QtyColumn = '<td class="text-center" id="qty' + indx + '">' + master_min[q].qty + '</td>';
                        var Unit = '<td class="text-center" id="unit' + indx + '">' + master_min[q].unit + '</td>';
                        var Unit_price = '<td class="text-end" id="price' + indx + '">' + master_min[q].price + '</td>';

                        row.append(checkboxColumn, indexColumn, CodeColumn, NameColumn, QtyColumn, Unit, Unit_price);
                        body.append(row);
                    }
                }
            });
            var detail_min = [];
            $.ajax({
                type: "post",
                url: "ajax_PO.php",
                data: {
                    function: 'min_stock'
                },
                success: function(data) {
                    for (j in data) {
                        detail_min.push(data[j]);
                    }
                    showDetails(detail_min);
                }
            });

            function showDetails(detail_min) {
                let len = detail_min.length;
                // loop object
                for (let q = 0; q < len; q++) {
                    var body = $('#showProduct tbody');
                    var row = $('<tr class="align-start" style="font-size: 16px;"></tr>');
                    var indx = q + 1;
                    var checkboxColumn = '<td class="text-center"><lable for="product"></label><input style="width:20px; height:20px;" type="checkbox" class="Cbxproduct" id="' + indx + '" value="' + detail_min[q].code + '"></td>'
                    var indexColumn = '<td class="text-center" id="col' + indx + '">' + indx + '</td>';
                    var CodeColumn = '<td class="text-center" id="code' + indx + '">' + detail_min[q].code + '</td>';
                    var NameColumn = '<td class="text-start" id="name' + indx + '">' + detail_min[q].name + '</td>';
                    var QtyColumn = '<td class="text-center" id="qty' + indx + '">' + detail_min[q].qty + '</td>';
                    var Unit = '<td class="text-center" id="unit' + indx + '">' + detail_min[q].unit + '</td>';
                    var Unit_price = '<td class="text-end" id="price' + indx + '">' + detail_min[q].price + '</td>';

                    row.append(checkboxColumn, indexColumn, CodeColumn, NameColumn, QtyColumn, Unit, Unit_price);
                    body.append(row);
                }
            }

            $('#ModalPO').click(function() {
                $('#allcheck').on("change", function() {
                    if ($('#allcheck').is(':checked')) {
                        for (let i = 0; i <= 6; i++) {
                            $('#' + i).prop('checked', true);
                        }
                        $('.Cbxproduct').not(':checked').prop('disabled', true);
                        $('.btn-submit').prop('disabled', false);
                    } else {
                        $('.Cbxproduct').prop('checked', false);
                        $('.Cbxproduct').removeProp('checked');
                        $('.Cbxproduct').not(':checked').prop('disabled', false);
                        $('.btn-submit').prop('disabled', true);
                    }
                });
                $('input[class=Cbxproduct]').change(function() {
                    var countChecked = $('input[class=Cbxproduct]:checked').length;
                    if (countChecked == 6) {
                        $('#allcheck').prop('checked', true);
                        $('.Cbxproduct').not(':checked').prop('disabled', true);
                    } else {
                        $('#allcheck').prop('checked', false);
                        $('#allcheck').removeProp('checked');
                        $('.Cbxproduct').not(':checked').prop('disabled', false);
                    }
                    if (countChecked == 0) {
                        $('.btn-submit').prop('disabled', true);
                    } else {
                        $('.btn-submit').prop('disabled', false);
                    }
                });

            });

            $('.btn-submit').click(function() {
                var arrCbx = [];
                $("input[class=Cbxproduct]").each(function() {
                    if ($(this).prop("checked")) {
                        arrCbx.push($(this).attr('id'));
                    }
                });

                var maker = $('#selectMaker').val();
                var maker_name = $('#company_name').html();
                var maker_addr = $('#addr').html();
                var arrProduct = arrCbx;
                let len = arrProduct.length;
                var code = "";
                var name = "";
                var qty = "";
                var unit = "";
                var price = "";
                var joinCol = [];
                // get date and set format
                const d = new Date();
                var datetimePO = moment(d).format('YYYY-MM-DD HH:mm:ss');

                for (h = 0; h < len; h++) {
                    Code = $("#code" + arrProduct[h]).html();
                    Name = $("#name" + arrProduct[h]).html();
                    Qty = $("#qty" + arrProduct[h]).html();
                    Unit = $("#unit" + arrProduct[h]).html();
                    Price = $("#price" + arrProduct[h]).html();

                    joinCol.push({
                        PCode: Code,
                        Pname: Name,
                        Pqty: Qty,
                        Punit: Unit,
                        Price: Price,
                    })
                }
                var poNo = $('#po_no').val();
                let valid = true;
                $('[required]').each(function() {
                    if ($(this).is(':invalid') || !$(this).val()) valid = false;
                })
                if (!valid) {
                    Swal.fire({
                        title: '',
                        text: 'กรุณาเลือกผู้จำหน่าย!',
                        icon: 'error',
                    });
                } else {
                    $.ajax({
                        type: "post",
                        url: "ajax_PO.php",
                        data: {
                            date: datetimePO,
                            PONo: poNo,
                            arrCode: joinCol,
                            maker: maker,
                            makerName: maker_name,
                            makerAddr: maker_addr,
                            mail1: $('#mail1').val(),
                            mail2: $('#mail2').val(),
                            function: 'po_insert'
                        }
                    });
                    $('input[type=checkbox]').prop('checked', false);
                    $('input[type=checkbox]').removeProp('checked');
                    $.when($.ajax("ajax_PO.php")).then(localStorage.setItem('sendPONo', poNo), window.location.href = "PO.php");
                }

            });

            $('#btn-po').click(function() {
                // get date and set format
                const d = new Date();
                var datenow = d.getDate();
                var day_format = moment(d).format('YYMMDD');
                var datetimePO = moment(d).format('YYYY-MM-DD hh:mm:ss');
                var hours = d.getHours();
                var minutes = d.getMinutes();
                var no = 0;
                $('#ResetPONo').click(function() {
                    if (datenow == 31) {
                        localStorage.clickcount = 0;
                        window.location.reload();
                    }
                });
                if (typeof(Storage) !== "undefined") {
                    if (localStorage.clickcount) {
                        //********** WAIT **********
                        // if (datenow == 30 && hours == 13 && minutes == 14) {
                        //     localStorage.clickcount = 0;
                        // }
                        localStorage.clickcount = Number(localStorage.clickcount) + 1;
                    }
                }
                no = localStorage.clickcount;
                var full_po = day_format.concat(no);
                $('#po_no').val(full_po);
            });
        });
    </script>
</body>

</html>