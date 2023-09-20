<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAIKO</title>

    <link href="css/boostrap_531.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/bootstrap_531.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- navbar menu -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="stock.php">SAIKO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#NavMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="NavMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="stock.php">Stock list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="confirm.php">Confirmation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_new.php">Add New Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stockin.php">Stock In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Stock Out</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a type="button" class="btn btn-dark" href="maker.php">Maker</a>
                        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="maker_new.php">New Maker</a></li>
                            <li><a class="dropdown-item" href="maker_edit.php">Edit Maker</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="User_Request.php">Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="History.php">History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar menu -->
</body>

</html>