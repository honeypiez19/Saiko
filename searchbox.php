<?php
// create search
ini_set('display_errors', 1);
error_reporting(~0);

$search = null;
if (isset($_POST["txtKeyword"])) {
    $search = $_POST["txtKeyword"];
}

// connect
$servername = "192.168.100.122";
$username = "samt";
$password = "samtadmin12";
$db = "test_saiko";
$port = "3306";

$conn = new mysqli($servername, $username, $password, $db,$port);

//search condition
$sql = "SELECT * FROM testStock WHERE Product_name LIKE '$search%' or Product_code LIKE '$search%' ";

// check connect
if ($conn->query($sql) === false) {
    echo "Error" . $sql . "<br>" . $conn->error;
}
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<body>
    <!-- navbar menu -->
    <?php include 'header_nav.php' ?>

    <!-- table product -->
    <div class="container">
        <!-- search box -->
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <div class="row" style="margin-top: 30px;">
                <div class="input-group">
                    <label class="control-label"><b>Search Product Code or Name:</b></label>
                    <div class="col">
                        <input name="txtKeyword" type="text" class="form-control" id="txtKeyword" value="<?php echo $search; ?>" placeholder="type here">
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- end search box -->
    </div>
    
</body>

</html>