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
                <input class="myform" type="month" id="mount" min="2018-01" value="2023-01" />
            </div>
        </div>

        <div class="row" style="margin-bottom: 10px;">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr class="text-center">
                        <th style="width: 25%;">Date</th>
                        <th>Request</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- modal Stock In -->
        <div class="modal fade" id="ReqModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- head modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">รายการเบิก</h4>
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
                                    <th>PROD.NO</th>
                                    <th>PART</th>
                                    <th>วันที่เบิก</th>
                                    <th>ชื่อผู้เบิก</th>
                                </tr>
                            </thead>
                            <!-- details of product -->
                            <tbody id="ReqTable"></tbody>
                        </table>
                    </div>
                    <!-- footer modal -->
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
                url: "User_ajax_history.php",
                data: {
                    mount: cut_mount,
                    year: year,
                    function: 'dateMount'
                },
                success: function(data) {
                    // send date to 4 function
                    showTemplate(data);
                    DateReq(data);
                }
            });
        });

        function showTemplate(data) {
            var YearMount = $('#mount').val();
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
                var ColReq = '<td id="ReqDate' + (indx) + '"><input type="button" value="" class="myform" id="Req-btn' + (indx) + '" data-bs-toggle="modal" data-bs-target="#ReqModal" style="text-align:start; background-color:coral;"></input></td>';
                newRow.append(ColDate, ColReq);
                tbody.append(newRow);
                $('#Req-btn' + [indx]).hide();
            }
        }

        // date check and send date to function dateReq
        function DateReq(data) {
            let len = data;
            var Req_date = [];
            for (let i = 0; i <= len; i++) {
                var day = $('#Date' + [i]).text();

                // ajax Request
                $.ajax({
                    type: "POST",
                    url: "User_ajax_history.php",
                    data: {
                        id: day,
                        function: 'dateReq'
                    },
                    success: function(data) {
                        // loop data from php and push array of Product_code
                        for (n in data) {
                            Req_date.push(data[n]);
                        }
                        showReq(Req_date, i); // call function showReq, send array of code and index of date
                        if (Req_date.length > 0) {
                            $('#Req-btn' + [i]).show(); // if this date has value then show button
                        }
                        Req_date.splice(0, Req_date.length); // remove all elements in array for prevent duplicate value
                    }
                });
            }
        }

        // show length of array product_code to btn Req and call function for show Modal
        function showReq(Req_date, i) {
            var indexDate = i;
            var Req_code = [];
            var len = Req_date.length;
            $('#Req-btn' + [indexDate]).val(len); // show length of data in button

            for (let m = 0; m < len; m++) {
                var id_code = Req_date[m];
                var days = $('#Date' + [indexDate]).text(); // find date for send ajax to compare with date_req
                $.ajax({
                    type: "POST",
                    url: "User_ajax_history.php",
                    data: {
                        id: id_code,
                        datecheck: days,
                        function: 'Req_code'
                    },
                    success: function(data) {
                        for (j in data) {
                            Req_code.push(data[j]);
                        }
                        ReqModal(Req_code, indexDate); // send array details of product_code
                    }
                });
            }
        }

        // get object from ajax in_code then loop and show in modal
        function ReqModal(Req_code, indexDate) {
            let len = Req_code.length; // check length of object

            // loop object
            for (let x = 0; x < len; x++) {

                var Modal = $('#ReqModal').modal;
                var mbody = $('#ReqTable');
                var modalRow = $('<tr></tr>');
                var indx = x + 1;
                var indexColumn = '<td  class="text-center">' + indx + '</td>';
                var CodeColumn = '<td  class="text-center">' + Req_code[x].code + '</td>';
                var NameColumn = '<td >' + Req_code[x].name + '</td>';
                var QtyColumn = '<td  class="text-center">' + Req_code[x].qty + '</td>';
                var Unit = '<td  class="text-center">' + Req_code[x].unit + '</td>';
                var Prod = '<td  class="text-center">' + Req_code[x].prod + '</td>';
                var Part = '<td  class="text-center">' + Req_code[x].part + '</td>';
                var DateColumn = '<td  class="text-center">' + Req_code[x].datetime + '</td>';
                var NameReq = '<td  class="text-center">' + Req_code[x].name_req + '</td>';

                modalRow.append(indexColumn, CodeColumn, NameColumn, QtyColumn, Unit, Prod, Part, DateColumn, NameReq);
            }

            // when button clicked
            $('#Req-btn' + [indexDate]).click(function() {
                mbody.append(modalRow);
                var modal_body = document.querySelectorAll('#ReqTable tr');

                // check row before row of detail and remove
                if (modal_body.length > len) {
                    for (var i = 1; i < modal_body.length; i++) {
                        $('#ReqTable tr:first').remove();
                    }
                }
            });
        }
    </script>

</body>

</html>