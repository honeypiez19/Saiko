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

    <div class="container-sm myform" style="margin-top: 50px;" id="DivMain">
        <h1 class="heading" style="margin-top: 10px; margin-bottom: 20px">History</h1>

        <div class="row" style="margin-bottom: 40px; margin-left: 80px">
            <div class="col">
                <label for="month">Select date :</label>&emsp;
                <input class="myform" type="month" id="month" min="2018-01" value="<?= date('Y-m') ?>" />
            </div>
        </div>

        <div class="row justify-content-md-center" style="margin-bottom: 10px;">
            <table class="table table-bordered" id="myTable" style="width:60%">
                <thead>
                    <tr class="text-center">
                        <th style="width: 30%;">Date</th>
                        <th>Request</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- modal Request -->
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
                        <table class="table table-bordered" style="width:100%">
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
        $(document).ready(function() {
            getDateofmonth(); // show row of date in this month

            // get year & month from id month
            function getDateofmonth() {
                var YearMonth = $('#month').val();
                var year = YearMonth.substr(0, 4);
                var cut_month = YearMonth.slice(5);

                if (cut_month < 10) {
                    cut_month = cut_month.slice(1);
                }
                // ajax send date to function get date in month
                $.ajax({
                    type: "POST",
                    url: "User_ajax_history.php",
                    data: {
                        month: cut_month,
                        year: year,
                        function: 'datemonth'
                    },
                    success: function(data) {
                        showTemplate(data); // send date to show row of date
                    }
                });
            }

            $('#month').change(function() {
                $('#myTable tbody').children().remove() // romove table month before this month
                $('#ReqTable').children().remove() // romove duplicate row in modal
                getDateofmonth();
            });

            function showTemplate(data) {
                var Yearmonth = $('#month').val();
                for (let i = 1; i <= data; i++) {
                    var tbody = $('#myTable tbody');
                    var newRow = $('<tr class="text-center"></tr>');
                    var indx = tbody.find('tr').length + 1;

                    // check date 1-9 for add 0 to the front of date
                    if (indx < 10) {
                        var fulldate = Yearmonth.concat("-0", indx); // format of year-month-date
                    } else {
                        var fulldate = Yearmonth.concat("-", indx); // format of year-month-date
                    }
                    var ColDate = '<td><span id="Date' + (indx) + '" class="Date" value="' + fulldate + '">' + fulldate + '</span></td>';
                    var ColReq = '<td id="ReqDate' + (indx) + '"><input type="button" value="" class="myform" id="Req-btn' + (indx) + '" data-bs-toggle="modal" data-bs-target="#ReqModal" style="background-color:coral;"></input></td>';
                    newRow.append(ColDate, ColReq);
                    tbody.append(newRow);
                    $('#Req-btn' + [indx]).hide(); // hide button
                    
                    var Req_code = []; // array for push object of product
                    // ajax Request product
                    $.ajax({
                        type: "POST",
                        url: "User_ajax_history.php",
                        data: {
                            id: fulldate,
                            function: 'dateReq'
                        },
                        success: function(data) {
                            // loop data from php and push array of Product
                            for (n in data) {
                                Req_code.push(data[n]);
                            }
                            ReqModal(Req_code, i); // call function ReqModal, send array of code and index of date
                            if (Req_code.length > 0) {
                                $('#Req-btn' + [i]).show(); // if this date has value then show button
                            }
                            Req_code.splice(0, Req_code.length); // remove all elements in array for prevent duplicate value
                        }
                    });
                }
            }

            // get object from ajax then loop and show in modal
            function ReqModal(Req_code, i) {
                let len = Req_code.length; // check length of object
                $('#Req-btn' + [i]).val(Req_code.length); // show length of data in button
                var daycheck = $('#Date' + [i]).text(); // get date for check in Req_btn and show correct info
                // loop object
                for (let x = 0; x < len; x++) {
                    var ModalReq = $('#ReqModal').modal;
                    var mbody = $('#ReqTable');
                    var modalRow = $('<tr name="' + Req_code[x].day + '"></tr>');
                    var indx = x + 1;
                    var indexColumn = '<td class="text-center">' + indx + '</td>';
                    var CodeColumn = '<td class="text-start">' + Req_code[x].code + '</td>';
                    var NameColumn = '<td >' + Req_code[x].name + '</td>';
                    var QtyColumn = '<td class="text-center">' + Req_code[x].qty + '</td>';
                    var Unit = '<td class="text-center">' + Req_code[x].unit + '</td>';
                    var Prod = '<td class="text-center">' + Req_code[x].prod + '</td>';
                    var Part = '<td class="text-center">' + Req_code[x].part + '</td>';
                    var DateColumn = '<td class="text-center">' + Req_code[x].datetime + '</td>';
                    var NameReq = '<td class="text-center">' + Req_code[x].name_req + '</td>';

                    modalRow.append(indexColumn, CodeColumn, NameColumn, QtyColumn, Unit, Prod, Part, DateColumn, NameReq);
                    mbody.append(modalRow);
                }
                // when button clicked
                $('#Req-btn' + [i]).click(function() {
                    // find row and check name of row with daycheck
                    mbody.find("tr").each(function() {
                        if ($(this).attr('name') != daycheck) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>