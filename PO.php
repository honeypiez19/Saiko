<!-- connect database, searchbox and navbar menu -->
<?php include 'connect.php';
$sql = "select * from Stock";

$result = $conn->query($sql);
$result = mysqli_query($conn, $sql);

if ($conn->query($sql) === false) {
    echo "Error" . $sql . "<br>" . $conn->error;
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/bootstrap_531.min.js"></script>
    <script src="js/JsBarcode.all.min.js"></script>

</head>

<body>
    <?php include 'header_nav.php' ?>
    <!-- button send mail -->
    <div class="row justify-content-end" style="margin-top: 20px;">
        <div class="col-2"><a href="#" type="button" class="btn btn-outline-success btn-lg">Send mail</a></div>
    </div>

    <div class="container" style="font-style: italic;">
        <!-- table product -->
        <table class="table table-bordered" style="border-style:solid black;">
            <thead>
                <!-- head of page -->
                <tr class="text-center" style="border : hidden;">
                    <td colspan="6" style="font-size: 22px;">
                        SHIPO ASAHI MOULDS (THAILAND) CO.,LTD.
                    </td>
                </tr>
                <tr class="text-center" style="border : hidden;">
                    <td colspan="6" style="font-size: 20px;">
                        438 MOO 17 T.BANGSAOTHONG A.BANGSAOTHONG SAMUTPRAKARN 10570
                    </td>
                </tr>
                <tr class="text-start" style="border : hidden;">
                    <td colspan="6" style="font-size: 20px;">
                        TAX ID : 0115536004971 &emsp;&emsp;HEAD OFFICE &emsp;&emsp;TEL : (02) 7067800-3 &emsp;&emsp;FAX: (02) 7067805
                    </td>
                </tr>
                <tr style="border : hidden;">
                    <td colspan="4" style="font-size: 30px; text-indent:515px; padding-bottom:30px">
                        PURCHASE ORDER
                    </td>
                    <td class="text-center" colspan="2" style="font-size: 30px;border : hidden;">
                        <!-- PO no. barcode -->
                        <svg class="barcode" jsbarcode-format="CODE128" jsbarcode-value="PL2301664" jsbarcode-height="50" jsbarcode-displayValue="false">
                        </svg>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 18px;border : hidden;">
                        TO : &emsp;&emsp;SOMAT CO..LTD.<br>
                        &emsp;&emsp;&emsp;&emsp;NO.1 MD TOWER15TF FLOOR,ROOM C3, E <br>
                        &emsp;&emsp;&emsp;&emsp;SOI BANGNA-TRAD 25,BANGNA-TRAD ROAD,BANGNA <br>
                        TAXID:&emsp;0105549059591 &emsp;&emsp;สำนักงานใหญ่ <br>
                        DELIVERY TO: SHIPPO ASAHI MOULDS (THAILAND) CO..LTD.
                    </td>
                    <td style="border : hidden;">&nbsp;&nbsp;</td>
                    <td style="font-size: 18px; border : hidden;">
                        <br>
                        P.O. NO.<br>
                        DATE OF ISSUE<br>
                        DELIVERY TIME<br>
                        CREDIT TERM
                    </td>
                    <td style="font-size: 18px; border : hidden;">
                        <br>
                        PL2301664<br>
                        28/08/2023<br>
                        04/09/2023<br>
                        30 DAYS
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="padding-bottom: 4; border-right : hidden; border-left : hidden;">
                        WE WOULD LIKE TO PLACE AN ORDER FOR THE FOLLOWING GOODS AND CONDTION <br>
                        AND PLEASE SUPPLY ITS TO US WITHIN THE TIME SPECIFIED.
                    </td>
                </tr>
                <!-- head of table -->
                <tr class="text-center">
                    <th>ITEM</th>
                    <th>DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th>UNIT</th>
                    <th>UNIT-PRICE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <!-- show data -->
                <?php
                $no = 1;
                $sub_total = 0;
                $discount = 0;
                $grand = 0;
                // function convert number to text
                function gettxt(
                    $value,
                    $locale = 'en',
                    $style = NumberFormatter::SPELLOUT
                ) {
                    $fmt = new NumberFormatter($locale, $style);
                    return $fmt->format($value);
                }
                // loop data
                while ($row = $result->fetch_assoc()) :
                    $purchase = $row['Max'] - $row['Qty'];
                    $amount = $purchase * $row['Unit_price'];
                    if ($row['Qty'] <= "3") {
                        echo "<tr class='align-start'>
                        <td class='text-center'> " . $no . "</td>
                        <td class='text-start'> " . $row['Product_name'] . "<br>" . "&emsp;&emsp;" .
                            "<svg class='barcode'
                                jsbarcode-format='CODE128'
                                jsbarcode-value=" . $row['Product_code'] . "
                                jsbarcode-height='50'
                                jsbarcode-font='sans-serif'
                                jsbarcode-fontSize='16'
                                jsbarcode-fontoptions='italic'>
                            </svg>" . "<br>" . "</td>
                        <td class='text-center' style='width:15%'> " . $row['Unit'] . "</td>
                        <td class='text-center'> " . $purchase . "</td>
                        <td class='text-end' style='width:15%'> " . sprintf("%.2f", $row['Unit_price']) . "</td>
                        <td class='text-end' style='width:15%'> " . sprintf("%.2f", $amount) . "</td>
                    </tr> ";
                        $no++;
                        $sub_total += sprintf("%.2f", $amount);
                    }
                    $vat = $sub_total * 0.07;
                    $total = $sub_total - $discount;
                    $grand = $total + $vat;
                ?>
                <?php endwhile ?>
                <!-- footer -->
                <tr>
                    <td colspan="6" style="border-right : hidden; border-left: hidden; padding-bottom: 0; padding-top: 0.5px;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="border-right : hidden;"></td>
                    <td class="text-start" style="border-right : hidden;">
                        TOTAL : <br>
                        DISCOUNT : <br>
                        VAT 7% : <br>
                        TOTAL : <br>
                        GRAND TOTAL : <br>
                    </td>
                    <td class="text-end">
                        <?php echo sprintf("%.2f", $sub_total) . "<br>" .
                            sprintf("%.2f", $discount) . "<br>" .
                            sprintf("%.2f", $vat) . "<br>" .
                            sprintf("%.2f", $total) . "<br>" .
                            sprintf("%.2f", $grand) . "<br>";
                        ?>
                    </td>
                </tr>
                <!-- row of number to text -->
                <tr>
                    <td colspan="6" style="border-top: hidden;">
                        <?php
                        // check if grand is decimal
                        $txtgrand = sprintf("%.2f", $grand);
                        if (fmod($txtgrand, 1) !== 0.0) {
                            $num = intval($txtgrand); // cut only number not decimal
                            $txtnum = gettxt($num); // call function gettxt for convert num to txt
                            $digit = round($txtgrand - $num, 2); // grand - num and fix decimal 2 digit
                            $subdigit = substr($digit, 2); // cut only digit of grand - num
                            // check decimal
                            switch ($subdigit) {
                                case 1:
                                    $decimal = 10;
                                    break;
                                case 2:
                                    $decimal = 20;
                                    break;
                                case 3:
                                    $decimal = 30;
                                    break;
                                case 4:
                                    $decimal = 40;
                                    break;
                                case 5:
                                    $decimal = 50;
                                    break;
                                case 6:
                                    $decimal = 60;
                                    break;
                                case 7:
                                    $decimal = 70;
                                    break;
                                case 8:
                                    $decimal = 80;
                                    break;
                                case 9:
                                    $decimal = 90;
                                    break;
                                default:
                                    $decimal = $subdigit;
                            }
                            $txtdigit = gettxt($decimal); // call function gettxt for convert subdigit to txt
                            echo "( " . strtoupper($txtnum) . " BAHT AND " . strtoupper($txtdigit) . " STANG )";
                        } else {
                            echo "( " . strtoupper(gettxt($txtgrand)) . " BAHT )";
                        }
                        ?>
                    </td>
                </tr>
                <!-- row of signature -->
                <tr>
                    <td colspan="2">
                        PURCHASE REQUESTION NO. :TRE <br>
                        **M/C Section <br>
                        Ref.No.SO22-005748-2
                    </td>
                    <td class="text-center" colspan="2">Authorized Signature</td>
                    <td class="text-center" colspan="2">Authorized Signature</td>
                </tr>
                <tr style="border-top: hidden;">
                    <td colspan="2">
                        &emsp; <br>
                        &emsp; <br>
                    </td>
                    <td class="text-center" colspan="2">
                        .............................................<br>
                        ( MS.A ANCHANA ) <br>
                        MANAGER
                    </td>
                    <td class="text-center" colspan="2">
                        .............................................<br>
                        (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;) <br>
                        PRESIDENT
                    </td>
                </tr>
                <?php $conn->close(); ?>
                <!-- end connect database -->
            </tbody>
        </table>
        <!-- end table product -->
    </div>
    <!-- generate barcode -->
    <script>
        JsBarcode(".barcode").init();
    </script>
</body>

</html>