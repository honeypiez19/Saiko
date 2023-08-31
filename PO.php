<!-- connect database, searchbox and navbar menu -->
<?php include 'connect.php';
// include composer autoload
require_once 'vendor/autoload.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/bootstrap_531.min.js"></script>

</head>

<body>
    <?php include 'header_nav.php' ?>
    <div class="row justify-content-end" style="margin-top: 20px;">
        <div class="col-2"><a href="#" type="button" class="btn btn-outline-success btn-lg">Send mail</a></div>
    </div>
    <!-- table product -->
    <div class="container">
        <h1 class="heading">PURCHASE ORDER</h1>
        <table class="table table-bordered" style="border-style:solid black;">
            <thead>
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
                <!-- connect database -->
                <?php
                function barcode($code)
                {
                    $generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
                    return '<img src="data:image/jpeg;base64,' . base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_128, 2, 50)) . '">';
                }
                $no = 1;
                $sub_total = 0;
                $discount = 0;
                while ($row = $result->fetch_assoc()) :
                    $purchase = $row['Max'] - $row['Qty'];
                    if ($row['Qty'] <= "3") {
                        echo "<tr class='align-start'>
                        <td class='text-center'> " . $no . "</td>
                        <td class='text-start'> " . $row['Product_name'] . "<br><br>"
                            ."&emsp;&emsp;". barcode($row['Product_code']) . "<br>"
                            . $row['Product_code'] . "</td>
                        <td class='text-center'> " . $purchase . "</td>
                        <td class='text-center' style='width:15%'> " . $row['Unit'] . "</td>
                        <td class='text-end' style='width:15%'> " . number_format($row['Unit_price'], 2) . "</td>
                        <td class='text-end' style='width:15%'> " . number_format($row['Residual_value'], 2) . "</td>
                    </tr> ";
                        $no++;
                        $sub_total += $row['Residual_value'];
                    }
                    $vat = $sub_total * 0.07;
                    $total = $vat + ($sub_total - $discount);
                ?>
                <?php endwhile ?>
                <tr class="text-end">
                    <th colspan="6">
                        <?php echo "SUB TOTAL : " . number_format($sub_total, 2) . "<br>" .
                            "DISCOUNT : " . number_format($discount, 2) . "<br>" .
                            "VAT 7% : " . number_format($vat, 2) . "<br>" .
                            "TOTAL : " . number_format($total, 2) . "<br>";
                        ?></th>
                </tr>
                <?php $conn->close(); ?>
                <!-- end connect database -->
            </tbody>
        </table>
    </div>
    <!-- end table product -->
</body>

</html>