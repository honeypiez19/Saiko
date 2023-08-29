<!-- connect database, searchbox and navbar menu -->
<?php include 'connect.php' ?>
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
</head>

<body>
    <!-- navbar menu -->
    <?php include 'header_nav.php' ?>
    <!-- button import -->
    <div class="container">
        <!-- <?php echo $_SERVER['PHP_SELF'];
                echo "<br>";
                echo $_SERVER['SERVER_NAME'];
                echo "<br>";
                echo $_SERVER['HTTP_HOST']; ?> -->
        <div class="d-grid gap-2 col-6 mx-auto" style="margin-top: 50px;">
            <button type="button" class="btn btn-outline-info">Import</button>
            <button type="button" class="btn btn-outline-primary">Export</button>
        </div>
    </div>
    <!-- end button import -->
</body>

</html>