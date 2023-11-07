<!-- connect database -->
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
    <!-- navbar menu -->
    <?php include 'header_nav.php' ?>
    <div class="container-sm d-flex align-items-center justify-content-center" style="margin-top: 50px;">
        <div class="row justify-content-md-center myform" style="margin-top: 50px; margin-bottom: 50px; width: 30%">
            <form id="myresetform">
                <h1 class="heading" style="margin-top: 50px; margin-bottom: 60px">เปลี่ยนรหัสผ่าน</h1>
                
                <!-- for test -->
                <div class="col align-content-center">
                    <label for="usercode" class="form-label">Usercode :</label>
                    <select class="myform" style="width: 340px; height:40px" id="usercode">
                        <option value="" selected disabled>- user -</option>
                        <?php
                        $sql = "SELECT * FROM User";
                        $result = mysqli_query($conn, $sql);
                        foreach ($result as $row) { ?>
                            <option value="<?= $row['Usercode'] ?>"><?= $row['Usercode'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- for test -->

                <div class="col align-content-center">
                    <br><label for="resetpass" class="form-label">รหัสผ่านใหม่</label>
                    <input type="text" class="form-control" id="resetpass" required>
                    <br><label for="confirm" class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="text" class="form-control" id="confirm" required>
                </div>
            </form>
            <div class="col align-content-end" style="text-align: end; margin-top: 30px; margin-bottom: 20px;">
                <input type="reset" class="btn btn-outline-warning btn-reset">&emsp;
                <input type="submit" class="btn btn-outline-success btn-submit">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.btn-reset').click(function() {
            $('#myresetform').trigger("reset");
        });
        $('.btn-submit').click(function() {
            var usercode = $('#usercode').val();
            var newpass = $('#resetpass').val();
            var confirm = $('#confirm').val();
            let valid = true;
            $('[required]').each(function() {
                if ($(this).is(':invalid') || !$(this).val()) valid = false;
            })
            if (!valid) {
                Swal.fire({
                    title: '',
                    text: 'กรุณาป้อนรหัสผ่าน!',
                    icon: 'error',
                });
            } else {
                if (newpass == confirm && usercode != null) {
                    $.ajax({
                        type: "post",
                        url: "ajax_MasterUpdate.php",
                        data: {
                            usercode: usercode,
                            newpass: newpass,
                            function: 'resetpass'
                        },
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                    icon: 'success',
                                });
                                $('.btn-reset').click();
                            } else {
                                Swal.fire({
                                    title: 'Error:',
                                    text: data.message,
                                    icon: 'error',
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'รหัสผ่านไม่ตรงกันหรือไม่มีผู้ใช้',
                        icon: 'error',
                    });
                }
            }
        });
    </script>
</body>

</html>