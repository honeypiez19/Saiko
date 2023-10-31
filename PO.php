<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/bootstrap_531.min.js"></script>
    <script src="js/jquery_370.min.js"></script>
    <script src="js/JsBarcode.all.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script src="js/jspdf.debug.js"></script>
    <script src="js/domtoimage.min.js"></script>
</head>

<body>
    <?php include 'header_nav.php' ?>
    <!-- button send mail -->
    <!-- <div class="row justify-content-end" style="margin-top: 20px; margin-bottom: 20px;">
        <div class="col-2"><button id="sendmail" onclick="sendMail()" class="btn btn-outline-success btn-lg">Send mail</button></div>
    </div> -->

    <div class="container page" style="font-style: italic; margin-top: 30px">
        <form id="POpage" class="page">
            <div style="padding-left: 15px; padding-right: 15px; padding-top:10px; padding-bottom:10px;">
                <!-- table head -->
                <table class="table table-bordered setcolhead" style="margin-bottom:0px;">
                    <!-- head of page -->
                    <thead>
                        <!-- head of page -->
                        <tr>
                            <td colspan="5" style="text-align:center; text-indent:140px; font-size: 18px;">
                                SHIPPO ASAHI MOULDS (THAILAND) CO.,LTD.
                            </td>
                            <td style="border: hidden; text-align:end; font-size: 12px;"><span id="pagecount"></span></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="6" style="font-size: 16px;">
                                438 MOO 17 T.BANGSAOTHONG A.BANGSAOTHONG SAMUTPRAKARN 10570
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="6" style="font-size: 16px;">
                                TAX ID : 0115536004971 &emsp;HEAD OFFICE &emsp;TEL : (02) 7067800-3 &emsp;FAX: (02) 7067805
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-indent:295px; vertical-align: text-top;">
                                <span style="font-size: 20px;">PURCHASE ORDER</span>
                            </td>
                            <td colspan="2" class="text-center" style="text-indent:50px;">
                                <!-- PO no. barcode -->
                                <svg id="barcodePO"></svg>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="font-size: 14px; vertical-align: text-top;">
                                TO : &emsp;&emsp;<span id="CompanyName"></span><br>
                                <span id="CompanyAddr"></span><br>
                                TAXID:&emsp;<span id="CompanyTaxID"></span> <br>
                                DELIVERY TO: SHIPPO ASAHI MOULDS (THAILAND) CO..LTD.
                            </td>
                            <td>&emsp;&emsp;</td>
                            <td style="font-size: 16px; vertical-align: text-top;">
                                P.O. NO.<br>
                                DATE OF ISSUE<br>
                                DELIVERY TIME<br>
                                CREDIT TERM
                            </td>
                            <td style="font-size: 16px; vertical-align: text-top;">
                                <span name="po_no"></span> <br>
                                <span id="day_issue"></span> <br>
                                <span id="day_delivery"></span> <br>
                                30 DAYS
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="font-size: 12px; padding-bottom: 4px;">
                                WE WOULD LIKE TO PLACE AN ORDER FOR THE FOLLOWING GOODS AND CONDTION <br>
                                AND PLEASE SUPPLY ITS TO US WITHIN THE TIME SPECIFIED.
                            </td>
                        </tr>
                    </thead>
                </table>
                <!-- table product -->
                <table class="table table-bordered" style="margin-bottom:0px;" id="body">
                    <!-- head of table -->
                    <thead>
                        <tr class="text-center" style="font-size: 14px;">
                            <td style="width:5%; padding:0rem;">ITEM</td>
                            <td style="padding:0rem;">DESCRIPTION</td>
                            <td style="width:10%; padding:0rem;">QUANTITY</td>
                            <td style="padding:0rem;">UNIT</td>
                            <td style="width:12%; padding:0rem;">UNIT-PRICE</td>
                            <td style="width:10%; padding:0rem;">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- table footer -->
                <table class="table table-bordered">
                    <tfoot>
                        <!-- footer -->
                        <tr>
                            <td colspan="6" style="border-right:hidden; border-left: hidden; border-bottom:hidden; padding-bottom: 0; padding-top: 0.5px;"></td>
                        </tr>
                        <tr style="font-size: 14px;">
                            <td colspan="4" style="border-right:hidden; border-bottom:hidden; padding-top:0rem;"></td>
                            <td class="text-start" style="border-right:hidden; border-left:hidden; border-bottom:hidden; padding-top:0rem;">
                                <p style="text-indent: 2em; margin:0%">TOTAL :</p>
                                <p style="text-indent: 2em; margin:0%">DISCOUNT :</p>
                                <p style="text-indent: 2em; margin:0%">TOTAL :</p>
                                <p style="text-indent: 2em; margin:0%">VAT 7% :</p>
                                <p style="text-indent: 2em; margin:0%">GRAND TOTAL :</p>
                            </td>
                            <td class="text-end" style="border-left: hidden; border-bottom:hidden; padding-top:0rem;">
                                <span id="sub"></span><br>
                                <span id="dis"></span><br>
                                <span id="total"></span><br>
                                <span id="vat"></span><br>
                                <span id="grand"></span>
                            </td>
                        </tr>
                        <!-- row of number to text -->
                        <tr style="font-size: 14px;">
                            <td colspan="6" style="border-top: hidden; padding-top:0rem; padding-bottom :2px;">
                                <span id="convertnum"></span>
                            </td>
                        </tr>
                        <!-- row of signature -->
                        <tr style="font-size: 14px;">
                            <td colspan="2" style="padding-top : 0px; padding-bottom : 0px;">
                                <p>PURCHASE REQUESTION NO. :TR <br>STOCK</p><br>
                                <p style="margin:0%"><img src="image/P_kea.PNG" alt="sign purchase" style="width:80px;height:50px;"></p>
                            </td>
                            <td class="text-center" colspan="2" style="border-right: hidden; padding-top : 0px; padding-bottom : 0px;">&emsp;&emsp;Authorized Signature
                                <br><img src="image/P_Tuk.PNG" alt="sign manager" style="width:80px;height:60px;">
                                <p style="text-indent: 2em; margin:0%">(MS.ANCHANA)<br>&emsp;&emsp;MANAGER</p>
                            </td>
                            <td class="text-center" colspan="2" style="text-indent:80px; padding: 0rem;">Authorized Signature
                                <p style="margin:0%"><img src="image/Matsumotosan1.png" alt="sign president" style="width:100px;height:60px;"></p>
                                <p style="margin:0%">(MATSUMOTO SHIGEFUMI)<br>&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;PRESIDENT</p>
                            </td>
                        </tr>
                        <!-- <tr style="font-size: 14px;">
                        </tr> -->
                    </tfoot>
                </table>
            </div>
        </form>
    </div>

    <!-- </canvas> -->
    <script type="text/javascript">

        $(document).ready(function() {
            // set page of header
            var page = document.getElementById("POpage");
            var totalPages = Math.ceil(page.scrollHeight / 1123); // A4 at 96PPI is Height = 1123 px
            for (var i = 1; i <= totalPages; i++) {
                $('#pagecount').html("Page " + i + " / " + totalPages);
            }

            // get date and set format
            const d = new Date();
            var day_issue = moment(d).format('DD/MM/YYYY');
            var day_delivery = moment(d).add(7, 'days').format('DD/MM/YYYY');
            $('#day_delivery').html(day_delivery);
            $('#day_issue').html(day_issue);

            var po_no = localStorage.getItem('sendPONo'); // get PONo by localStorage from page Stock
            var datetimePO = moment(d).format('YYYY-MM-DD HH:mm:ss'); // format date of P.O.
            var datePO = $('#datepo').val();
            $('[name="po_no"]').text(po_no);
            //barcode of PONo
            JsBarcode("#barcodePO", po_no, {
                format: "CODE128",
                height: 35,
                displayValue: false
            });

            // show maker detail
            $.ajax({
                type: "POST",
                url: "ajax_PO.php",
                data: {
                    PONo: po_no,
                    function: 'po_maker'
                },
                success: function(data) {
                    $('#CompanyTaxID').html(data.taxID);
                    $('#CompanyName').html(data.name);
                    $('#CompanyAddr').html(data.addr);
                }
            }).then(() => {
                setTimeout(function() {
                    // call db for get row of product
                    getPOdetails();
                }, 1000);
            }).then(() => {
                setTimeout(function() {
                    // call db for get row of product
                    getAmount();
                }, 1000);
            }).then(() => {
                // gen pdf and save
                setTimeout(function() {
                    scshot();
                }, 2000);
            }).then(() => {
                // gen pdf and save
                setTimeout(function() {
                    sendMail();
                }, 4000);
            });

            // call db for get row of product
            function getPOdetails() {
                $.ajax({
                    type: "POST",
                    url: "ajax_PO.php",
                    data: {
                        PONo: po_no,
                        function: 'po_details'
                    },
                    success: function(data) {
                        var detail_po = [];
                        for (j in data) {
                            detail_po.push(data[j]);
                        }
                        showDetails(detail_po);
                    }
                })
            }
            // row of product
            function showDetails(detail_po) {
                let len = detail_po.length;

                // loop object
                for (let q = 0; q < len; q++) {
                    var body = $('#body tbody');
                    var row = $('<tr class="align-start" style="font-size: 14px;"></tr>');
                    var indx = q + 1;
                    var indexColumn = '<td class="text-center" style="padding-top : 0px; padding-bottom : 0px;">' + indx + '</td>';
                    var NameColumn = '<td class="text-start" style="padding-top : 0px; padding-bottom : 0px;">' + detail_po[q].name + '<br>' + '<svg class="barcode" jsbarcode-value="' +
                        detail_po[q].code + '" jsbarcode-height="30" jsbarcode-font="sans-serif" jsbarcode-fontSize=14 jsbarcode-fontOptions="italic"></svg><br></td>';
                    var QtyColumn = '<td class="text-center" style="padding-top : 0px; padding-bottom : 0px;">' + detail_po[q].qty + '</td>';
                    var Unit = '<td class="text-center" style="padding-top : 0px; padding-bottom : 0px;">' + detail_po[q].unit + '</td>';
                    var Unit_price = '<td class="text-end" style="padding-top : 0px; padding-bottom : 0px;">' + detail_po[q].price + '</td>';
                    var AmountColumn = '<td class="text-end" style="padding-top : 0px; padding-bottom : 0px;">' + detail_po[q].amount + '</td>';

                    row.append(indexColumn, NameColumn, QtyColumn, Unit, Unit_price, AmountColumn);
                    body.append(row);
                }
                JsBarcode(".barcode").init();
                if (len < 7) {
                    let newRow = 6 - len;
                    for (let i = 0; i < newRow; i++) {
                        var body = $('#body tbody');
                        var row = $('<tr></tr>');
                        var indexColumn = '<td style="padding-top : 0px; padding-bottom : 0px; height:88px;">&emsp;</td>';
                        var NameColumn = '<td style="padding-top : 0px; padding-bottom : 0px; height:88px;">&emsp;</td>';
                        var QtyColumn = '<td style="padding-top : 0px; padding-bottom : 0px; height:88px;">&emsp;</td>';
                        var Unit = '<td style="padding-top : 0px; padding-bottom : 0px; height:88px;">&emsp;</td>';
                        var Unit_price = '<td style="padding-top : 0px; padding-bottom : 0px; height:88px;">&emsp;</td>';
                        var AmountColumn = '<td style="padding-top : 0px; padding-bottom : 0px; height:88px;">&emsp;</td>';

                        row.append(indexColumn, NameColumn, QtyColumn, Unit, Unit_price, AmountColumn);
                        body.append(row);
                    }
                }
            }
            // call ajax for show amount
            function getAmount() {
                $.ajax({
                    type: "POST",
                    url: "ajax_PO.php",
                    data: {
                        PONo: po_no,
                        function: 'po_amount'
                    },
                    success: function(data) {
                        $('#convertnum').html(data.text);
                        $('#sub').html(data.sub);
                        $('#dis').html(data.dis);
                        $('#total').html(data.total);
                        $('#vat').html(data.vat);
                        $('#grand').html(data.grand);
                    }
                });
            }
            // gen pdf and save
            function scshot() {
                var po_file = $('[name="po_no"]').text();
                var node = document.getElementById('POpage');
                var scale = 2;
                var specialElementHandlers = {
                    "#editor": function(element, rendrer) {
                        return true;
                    }
                };
                var pdf = new jsPDF();

                domtoimage.toJpeg(node, {
                        quality: 0.98,
                        width: node.clientWidth * scale,
                        height: node.clientHeight * scale,
                        style: {
                            transform: "scale(" + scale + ")",
                            transformOrigin: "top left"
                        }
                    })
                    .then(function(imgData) {
                        var pdf = new jsPDF("p", "mm", [
                            $("#POpage").width(),
                            $("#POpage").height()
                        ]);
                        pdf.addImage(
                            imgData, "JPEG", 0, 0,
                            $("#POpage").width(),
                            $("#POpage").height()
                        );
                        pdf.save('PO' + po_file);
                    });
            }
            // send mail
            function sendMail() {
                var po_file = $('[name="po_no"]').text();
                $.ajax({
                    type: "POST",
                    url: "ajax_POMail.php",
                    data: {
                        PONo: po_file,
                        function: 'sendMail'
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            Swal.fire({
                                title: 'Success',
                                text: 'E-mail has been sent successfully!',
                                icon: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: 'Error:',
                                text: data.message,
                                icon: 'error',
                            });
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>