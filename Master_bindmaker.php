<!-- connect database -->
<?php include 'connect.php';
$sql = "SELECT * FROM Stock";
$result = mysqli_query($conn, $sql);

if ($conn->query($sql) === false) {
    echo "Error" . $sql . "<br>" . $conn->error;
} ?>
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
        <div class="row justify-content-end" style="padding-right:10px;">
            <div class="col-2" style="margin-top: 30px;"><a type="button" class="btn btn-outline-info btn-lg">Import</a></div>
        </div>
        <h1 class="heading" style="margin-top: 30px; margin-bottom: 60px">เพิ่มสินค้าที่จะสั่งซื้อกับผู้จำหน่าย</h1>
        <div class="row" style="font-size: 18px; margin-top:40px; margin-bottom:30px">
            <div class="col-1"></div>

            <!-- select maker -->
            <div class="col-3">
                <span>ผู้จำหน่าย :</span><br>
                <select class="myform" style="width:250px; height:40px" id="taxid" required>
                    <option value="" selected disabled>- กรุณาเลือกผู้จำหน่าย -</option>
                    <?php
                    $sql2 = "select TaxID, Company_name from Maker";
                    $query2 = mysqli_query($conn, $sql2);
                    foreach ($query2 as $row) { ?>
                        <option value="<?= $row['TaxID'] ?>"><?= $row['Company_name'] ?></option>
                    <?php } ?>
                </select>
                <span class="error">*</span>

                <!-- get name="taxid" to check in database -->
                <input name="taxid" type="hidden" value="">
            </div>

            <!-- datalist stock -->
            <div class="col-5" style="vertical-align: text-top;">
                <span>ค้นหารหัสสินค้าหรือชื่อสินค้า :</span>
                <!-- send name="P_code" to check in database -->
                <input class="myform" list="Productlist" autocomplete="off" style="width:550px; height:40px" type="search" name="P_code" value="">

                <!-- datalist show Product_code of database -->
                <datalist id="Productlist">
                    <?php
                    $sql2 = "SELECT Product_code, Product_name FROM Product ";
                    $query2 = mysqli_query($conn, $sql2);
                    foreach ($query2 as $row) { ?>
                        <option value="<?= $row['Product_code'] ?>"><?= $row['Product_name'] ?></option>
                    <?php } ?>
                </datalist>
            </div>

            <div class="col" style="margin-left: 20px;">
                <br><input type="submit" name="submit" class="btn btn-outline-success btn-submit" value="ค้นหา">
            </div>

        </div>

        <h3 class="heading">รายการสินค้า</h3>
        <div class="row justify-content-md-center">
            <table class="table table-bordered" id="myTable" style="width:80%">
                <thead>
                    <tr class="text-center">
                        <th>ลำดับที่</th>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>หน่วย</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>เพิ่มสินค้า</th>
                    </tr>
                </thead>
                <tbody id="body">
                    <form>
                        <!-- connect database -->
                        <?php
                        $no = 1;
                        while ($row = $result->fetch_assoc()) :
                            $trow = "<tr class='align-middle'>";
                            $colindx = "<td class='text-center'> " . $no . "</td>";
                            $colCode = "<td id='code" . $no . "'> " . $row['Product_code'] . "</td>";
                            $colName = "<td id='name" . $no . "'> " . $row['Product_name'] . "</td>";
                            $colUnit = "<td class='text-center'> " . $row['Unit'] . "</td>";
                            $colPrice = "<td class='text-end'> " . $row['Unit_price'] . "</td>";
                            $coladd = "<td class='text-center'><input type='button' class='btn btn-outline-warning btn-add' id='" . $no . "' onclick='AddGoods(this)' value='เพิ่ม'></td></tr>";

                            echo $trow . $colindx . $colCode . $colName . $colUnit . $colPrice . $coladd;
                            $no++;
                        endwhile;
                        ?>
                        <?php $conn->close(); ?>
                        <!-- end connect database -->
                    </form>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $('.btn-submit').click(function() {
            var ProductCode = $('[name="P_code"]').val();
            //alert(ProductCode);
            var maker = $('[name="taxid"]').val();
            var detailStock = [];
            $.ajax({
                type: "post",
                url: "ajax_MasterUpdate.php",
                data: {
                    ProductCode: ProductCode,
                    maker: maker,
                    function: 'findProduct'
                },
                success: function(data) {
                    for (i in data) {
                        if (data[i].status == 1) {
                            detailStock.push(data[i]);
                        } else {
                            Swal.fire({
                            title: data[i].message,
                            text: 'ไม่มีรหัสสินค้านี้',
                            icon: 'error',
                        });
                        }
                    }
                    ShowRowStock(detailStock);
                }
            });
        });

        $(window).on("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                $('.btn-submit').click();
            }
        });

        $('#taxid').change(function() {
            var maker = $('#taxid').val();
            $('[name="taxid"]').val(maker);
            var detailStock = [];
            $.ajax({
                type: "post",
                url: "ajax_MasterUpdate.php",
                data: {
                    maker: maker,
                    function: 'bindmaker'
                },
                success: function(data) {
                    for (i in data) {
                        detailStock.push(data[i]);
                    }
                    ShowRowStock(detailStock);
                }
            });
        });

        function ShowRowStock(detailStock) {
            let len = detailStock.length;
            var tbody = $('#body');

            $('#body').children().remove() // remove row before row of detail
            for (let j = 0; j < len; j++) {
                var no = j + 1;
                if (detailStock[j].compare) {
                    if (detailStock[j].compare == 'Equal') {
                        var row = $('<tr class="align-middle table-info">');
                        var coladd = "<td class='text-center'><input type='button' class='btn btn-outline-secondary btn-add' id='" + no + "' onclick='AddGoods(this)' value='เพิ่ม' disabled></td></tr>";
                    } else {
                        var row = $('<tr class="align-middle">');
                        var coladd = "<td class='text-center'><input type='button' class='btn btn-outline-warning btn-add' id='" + no + "' onclick='AddGoods(this)' value='เพิ่ม'></td></tr>";
                    }
                    var colindx = "<td class='text-center'> " + no + "</td>";
                    var colCode = "<td ><span id='code" + no + "'>" + detailStock[j].code + "</span></td>";
                    var colName = "<td > " + detailStock[j].name + "</td>";
                    var colUnit = "<td class='text-center'> " + detailStock[j].unit + "</td>";
                    var colPrice = "<td class='text-end'> " + detailStock[j].price + "</td>";

                    row.append(colindx, colCode, colName, colUnit, colPrice, coladd);
                    tbody.append(row);
                } else {
                    var row = $('<tr class="align-middle">');
                    var colindx = "<td class='text-center'> " + no + "</td>";
                    var colCode = "<td ><span id='code" + no + "'>" + detailStock[j].code + "</span></td>";
                    var colName = "<td > " + detailStock[j].name + "</td>";
                    var colUnit = "<td class='text-center'> " + detailStock[j].unit + "</td>";
                    var colPrice = "<td class='text-end'> " + detailStock[j].price + "</td>";
                    var coladd = "<td class='text-center'><input type='button' class='btn btn-outline-warning btn-add' id='" + no + "' onclick='AddGoods(this)' value='เพิ่ม'></td></tr>";

                    row.append(colindx, colCode, colName, colUnit, colPrice, coladd);
                    tbody.append(row);
                }
            }
        }

        function AddGoods(i) {
            let valid = true;
            $('[required]').each(function() {
                if ($(this).is(':invalid') || !$(this).val()) valid = false;
            })
            var n = $(i).attr("id");
            var code = $("#code" + n).text();
            var maker = $('[name="taxid"]').val();
            if (!valid) {
                Swal.fire({
                    title: '',
                    text: 'กรุณาเลือกผู้จำหน่าย!',
                    icon: 'error',
                });
            } else {
                $.ajax({
                    type: "post",
                    url: "ajax_MasterUpdate.php",
                    data: {
                        Pcode: code,
                        id_maker: maker,
                        function: 'insert_bindmaker'
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Add Product Successfully!',
                                icon: 'success',
                                allowOutsideClick: false,
                                allowEscapeKey: true,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('.btn-submit').click();
                                }
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
        }

        $(window).on("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                $('.btn-submit').click();
            }
        });

        // prevent alert Confirm Form Resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>