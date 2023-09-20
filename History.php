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
        <!-- table product -->
        <div class="row">
            <!-- get date from here -->
            <label><?php echo $date; ?></label>

            <input type="hidden" id="Date" value="<?php echo $date ?>"></input>
            <br><input type="text" id="result2" value="">
            <br><button type="text" onclick="showdate()">Click</button>
            <br><input type="text" id="result">
            <!-- <button type="text" onclick="showdate()">Click</button> -->
        </div>
        <!-- template show info -->
        <template>
            <label class="myform" style="background-color:paleturquoise;">Stock In</label>
        </template>
        <template>
            <label class="myform" style="background-color:plum;">Stock Out</label>
        </template>
        <template>
            <label class="myform" style="background-color:darkseagreen;">Add New Product</label>
        </template>

    </div>
    <script type="text/javascript">
        var Divbody = $('#DivMain'); // find div id DivMain
        var newRow = $('<div class="row"></div>'); // new div row
        let myArr = ["Audi", "BMW", "Ford", "Honda", "Jaguar", "Nissan"];

        function showdate() {
            var id_code = $('#result2').val();
            //$('#result2').val(id_code);
            $.ajax({
                type: "POST",
                url: "ajax_history.php",
                data: {
                    id: id_code,
                    function: 'code'
                },
                success: function(data) {
                    $('#result').val(data.name);
                }
            });
        }
        $('#result2').ready(function() {
            var id = $('#result2').val();

            $.ajax({
                type: "POST",
                url: "ajax_history.php",
                data: {
                    id: id,
                    function: 'code'
                },
                success: function(data) {
                    //$('#result').val(data.name);
                    //showdate(data);
                }
            });
        });

        // function showContent() {
        //     temp = document.getElementsByTagName("template")[0];
        //     //get the label element from the template:
        //     item = temp.content.querySelector("label");
        //     //for each item in the array:
        //     for (i = 0; i < myArr.length; i++) {
        //         //Create a new node, based on the template:
        //         a = document.importNode(item, true);
        //         //Add data from the array:
        //         a.textContent += myArr[i];
        //         //append the new node
        //         newRow.append(a);
        //         Divbody.append(newRow)
        //     }
        // }
    </script>

</body>

</html>