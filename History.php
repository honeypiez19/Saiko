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

    <div class="container myform" style="margin-top: 50px;" id="DivMain">
        <h1 class="heading" style="margin-top: 10px; margin-bottom: 20px">History</h1>

        <div class="row" style="margin-bottom: 50px;">
            <div class="col">
                <label for="mount">Select date :</label>&emsp;
                <input class="myform" type="month" id="mount" min="2023-01" value="2023-01" />
            </div>
        </div>

        <div class="row" style="margin-bottom: 10px;">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr class="text-center">
                        <th style="width: 25%;">Date</th>
                        <th style="width: 25%;">Stock In</th>
                        <th style="width: 25%;">Stock Out</th>
                        <th style="width: 25%;">Add New Product</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- modal Stock In -->
        <div class="modal fade" id="StInModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- head modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">รายการ Stock In</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- table show product in modal -->
                        <table style="width:100%">
                            <!-- head table -->
                            <thead>
                                <tr class="text-center">
                                    <th>ลำดับที่</th>
                                    <th>เลข P.O.</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>หน่วย</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>วันที่รับเข้า</th>
                                </tr>
                            </thead>
                            <!-- details of product -->
                            <tbody id="StInTable"></tbody>
                        </table>
                    </div>
                    <!-- footer modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal Stock Out -->
        <div class="modal fade" id="StOutModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">รายการ Stock Out</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- table show product in modal -->
                        <table style="width:100%">
                            <!-- head table -->
                            <thead>
                                <tr class="text-center">
                                    <th>ลำดับที่</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>หน่วย</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>วันที่จ่ายของ</th>
                                </tr>
                            </thead>
                            <!-- details of product -->
                            <tbody id="StOutTable"></tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal Add New Product -->
        <div class="modal fade" id="AddModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">รายการ Add New Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- table show product in modal -->
                        <table style="width:100%">
                            <!-- head table -->
                            <thead>
                                <tr class="text-center">
                                    <th>ลำดับที่</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>หน่วย</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>วันที่เพิ่ม</th>
                                </tr>
                            </thead>
                            <!-- details of product -->
                            <tbody id="AddTable"></tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#mount').change(function() {
            $('#myTable tbody').children().remove() // romove table mount before this mount

            // get year & mount from id mount
            var YearMount = $('#mount').val();
            var year = YearMount.substr(0, 4);
            var cut_mount = YearMount.slice(5);

            if (cut_mount < 10) {
                cut_mount = cut_mount.slice(1);
            }

            // ajax send date to function get date in mount
            $.ajax({
                type: "POST",
                url: "ajax_history.php",
                data: {
                    mount: cut_mount,
                    year: year,
                    function: 'dateMount'
                },
                success: function(data) {
                    // send date to 4 function
                    showTemplate(data); 
                    Datecheck1(data);
                    Datecheck2(data);
                    Datecheck3(data);
                }
            });
        });

        function showTemplate(data) {
            var YearMount = $('#mount').val();
            var len = data.length;
            for (let i = 0; i < data; i++) {
                var tbody = $('#myTable tbody');
                var newRow = $('<tr class="text-center"></tr>');
                var indx = tbody.find('tr').length + 1;

                // check date 1-9 for add 0 to the front of date
                if (indx < 10) {
                    var fulldate = YearMount.concat("-0", indx); // format of year-mount-date
                } else {
                    var fulldate = YearMount.concat("-", indx); // format of year-mount-date
                }

                var ColDate = '<td><span id="Date' + (indx) + '" class="Date" value="' + fulldate + '">' + fulldate + '</span></td>';
                var ColStIn = '<td id="StIn' + (indx) + '"><input type="button" value="" class="myform" id="StockIn' + (indx) + '" data-bs-toggle="modal" data-bs-target="#StInModal" style="text-align:start; background-color:plum;"></input></td>';
                var ColStOut = '<td id="StOut' + (indx) + '"><input type="button" value="" class="myform" id="StockOut' + (indx) + '" data-bs-toggle="modal" data-bs-target="#StOutModal" style="text-align:start; background-color:paleturquoise;"></input></td>';
                var ColAdd = '<td id="Add' + (indx) + '"><input type="button" value="" class="myform" id="AddNew' + (indx) + '" data-bs-toggle="modal" data-bs-target="#AddModal" style="text-align:start; background-color:lightskyblue;"></input></td>';
                newRow.append(ColDate, ColStIn, ColStOut, ColAdd);
                tbody.append(newRow);
                $('#StockIn' + [indx]).hide();
                $('#StockOut' + [indx]).hide();
                $('#AddNew' + [indx]).hide();
            }
        }

        // date check and send date to function datein
        function Datecheck1(data) {
            let len = data;
            var StIn = [];
            for (let i = 0; i <= len; i++) {
                var id = $('#Date' + [i]).text();

                // ajax Stock In
                $.ajax({
                    type: "POST",
                    url: "ajax_history.php",
                    data: {
                        id: id,
                        function: 'dateIn'
                    },
                    success: function(data) {
                        // loop data from php and push array of P.O.No
                        for (n in data) {
                            StIn.push(data[n]);
                        }
                        showIn(StIn, i);  // call function showIn and send array of P.O.No and i (num of date)
                        if (StIn.length > 0) {
                            $('#StockIn' + [i]).show();  // if this date has value then show button
                        }
                        StIn.splice(0, StIn.length); // remove all elements in an array for prevent duplicate value
                    }
                });
            }
        }

        // date check and send date to function dateOut
        function Datecheck2(data) {
            let len = data;
            var StOut = [];
            for (let i = 0; i <= len; i++) {
                var id = $('#Date' + [i]).text();

                // ajax Stock Out
                $.ajax({
                    type: "POST",
                    url: "ajax_history.php",
                    data: {
                        id: id,
                        function: 'dateOut'
                    },
                    success: function(data) {
                        for (m in data) {
                            StOut.push(data[m]);
                        }
                        showOut(StOut, i);
                        if (StOut.length > 0) {
                            $('#StockOut' + [i]).show();
                        }
                        StOut.splice(0, StOut.length); // remove all elements in an array for prevent duplicate value
                    }
                });
            }
        }

        // date check and send date to function dateAdd
        function Datecheck3(data) {
            let len = data;
            var add = [];
            for (let i = 0; i <= len; i++) {
                var id = $('#Date' + [i]).text();

                // ajax Add
                $.ajax({
                    type: "POST",
                    url: "ajax_history.php",
                    data: {
                        id: id,
                        function: 'dateAdd'
                    },
                    success: function(data) {
                        // loop data from php and push array and send array of product_code to showAdd()
                        for (o in data) {
                            add.push(data[o]);
                        }
                        showAdd(add,i);
                        if (add.length > 0) {
                            $('#AddNew' + [i]).show();
                        }
                        add.splice(0, add.length);
                    }
                });
            }
        }

        // show length of array product_code to btn Stock In and call function for show Modal
        function showIn(StIn, i) {
            var indexDate = i;
            var In_code = [];
            var len = StIn.length;
            $('#StockIn' + [indexDate]).val(len);

            for (let m = 0; m <= len; m++) {
                var id_code = StIn[m];
                var days = $('#Date' + [indexDate]).text(); // find date for send ajax to compare with date_add
                $.ajax({
                    type: "POST",
                    url: "ajax_history.php",
                    data: {
                        id: id_code,
                        datecheck: days,
                        function: 'In_code'
                    },
                    success: function(data) {
                        for (j in data) {
                            In_code.push(data[j]);
                        }
                        InModal(In_code, indexDate); // send array details of product_code
                    }
                });
            }
        }

        // get object from ajax in_code then loop and show in modal
        function InModal(In_code, indexDate) {
            let len = In_code.length; // check length of object

            // loop object
            for (let x = 0; x < len; x++) {
                var Modal = $('#StInModal').modal;
                var mbody = $('#StInTable');
                var modalRow = $('<tr></tr>');
                var indx = x + 1;
                var indexColumn = '<td  class="text-center">' + indx + '</td>';
                var POColumn = '<td  class="text-center">' + In_code[x].PONo + '</td>';
                var CodeColumn = '<td  class="text-center">' + In_code[x].code + '</td>';
                var NameColumn = '<td >' + In_code[x].name + '</td>';
                var QtyColumn = '<td  class="text-center">' + In_code[x].qty + '</td>';
                var Unit = '<td  class="text-center">' + In_code[x].unit + '</td>';
                var Unit_price = '<td  class="text-end">' + In_code[x].unit_price + '</td>';
                var DateColumn = '<td  class="text-center">' + In_code[x].datetime + '</td>';

                modalRow.append(indexColumn, POColumn, CodeColumn, NameColumn, QtyColumn, Unit, Unit_price, DateColumn);
            }

            // when button clicked
            $('#StockIn' + [indexDate]).click(function() {
                mbody.append(modalRow);
                var modal_body = document.querySelectorAll('#StInTable tr');
                //$('#result0').val(modal_body.length);

                // check row before row of detail and remove
                if (modal_body.length > len) {
                    for (var i = 1; i < modal_body.length; i++) {
                        $('#StInTable tr:first').remove();
                    }
                }
            });
        }

        // call template and append btn Stock Out
        function showOut(StOut, i) {
            var indexDate = i;
            var Out_code = [];
            let len = StOut.length;
            $('#StockOut' + [indexDate]).val(len);

            for (let i = 0; i <= len; i++) {
                var id_code = StOut[i];
                var days = $('#Date' + [indexDate]).text(); // find date for send ajax to compare with date_add
                $.ajax({
                    type: "POST",
                    url: "ajax_history.php",
                    data: {
                        id: id_code,
                        datecheck: days,
                        function: 'Out_code'
                    },
                    success: function(data) {
                        for (j in data) {
                            Out_code.push(data[j]);
                        }
                        OutModal(Out_code, indexDate);
                    }
                });
            }
        }

        // get object from ajax out_code then loop and show in modal
        function OutModal(Out_code, indexDate) {
            let len = Out_code.length;
            // loop object
            for (let q = 0; q < len; q++) {
                var Modal = $('#StOutModal').modal;
                var mbody = $('#StOutTable');
                var modalRow = $('<tr></tr>');
                var indx = q + 1;
                var indexColumn = '<td  class="text-center">' + indx + '</td>';
                var CodeColumn = '<td  class="text-center">' + Out_code[q].code + '</td>';
                var NameColumn = '<td >' + Out_code[q].name + '</td>';
                var QtyColumn = '<td  class="text-center">' + Out_code[q].qty + '</td>';
                var Unit = '<td  class="text-center">' + Out_code[q].unit + '</td>';
                var Unit_price = '<td  class="text-end">' + Out_code[q].unit_price + '</td>';
                var DateColumn = '<td  class="text-center">' + Out_code[q].datetime + '</td>';

                modalRow.append(indexColumn, CodeColumn, NameColumn, QtyColumn, Unit, Unit_price, DateColumn);
            }


            // when button clicked
            $('#StockOut' + [indexDate]).click(function() {
                mbody.append(modalRow);
                var modal_body = document.querySelectorAll('#StOutTable tr');

                // check row before row of detail and remove
                if (modal_body.length > len) {
                    for (var i = 1; i < modal_body.length; i++) {
                        $('#StOutTable tr:first').remove();
                    }
                }
            });

        }

        // call template and append btn Add New Product
        function showAdd(add,i) {
            var indexDate = i;
            var add_code = [];
            let len = add.length;
            $('#AddNew' + [indexDate]).val(len);

            for (let i = 0; i <= len; i++) {
                var id_code = add[i];
                var days = $('#Date' + [indexDate]).text(); // find date for send ajax to compare with date_add
                $.ajax({
                    type: "POST",
                    url: "ajax_history.php",
                    data: {
                        id: id_code,
                        datecheck: days,
                        function: 'add_code'
                    },
                    success: function(data) {
                        // loop data from php and push array of object product to send AddModal()
                        for (k in data) {
                            add_code.push(data[k]);
                        }
                        AddModal(add_code,indexDate);
                    }
                });
            }
        }

        // get object from ajax add_code then loop and show in modal
        function AddModal(add_code,indexDate) {
            let len = add_code.length; // check length of object

            // loop object
            for (h = 0; h < len; h++) {
                var Modal = $('#AddModal').modal; // find modal by id
                var mbody = $('#AddTable'); // find table by id
                var modalRow = $('<tr></tr>'); // create new row
                var indx = h + 1; // get index of row from h
                var indexColumn = '<td  class="text-center">' + indx + '</td>'; // create column for show index
                var CodeColumn = '<td  class="text-center">' + add_code[h].code + '</td>'; // create column for show Product_code
                var NameColumn = '<td >' + add_code[h].name + '</td>'; // create column for show Product_name
                var QtyColumn = '<td  class="text-center">' + add_code[h].qty + '</td>';
                var Unit = '<td  class="text-center">' + add_code[h].unit + '</td>';
                var Unit_price = '<td  class="text-end">' + add_code[h].unit_price + '</td>';
                var DateColumn = '<td  class="text-center">' + add_code[h].datetime + '</td>';

                modalRow.append(indexColumn, CodeColumn, NameColumn, QtyColumn, Unit, Unit_price, DateColumn); // append all column in row
            }

            // when button clicked
            $('#AddNew' + [indexDate]).click(function() {
                mbody.append(modalRow);
                var modal_body = document.querySelectorAll('#AddTable tr');
                //$('#result0').val(modal_body.length); // show row

                // check row before row of detail and remove
                if (modal_body.length > len) {
                    for (var i = 1; i < modal_body.length; i++) {
                        $('#AddTable tr:first').remove();
                    }
                }
            });
        }
    </script>

</body>

</html>