<?php
include 'connect.php';
require 'PHPMailer/PHPMailerAutoload.php';
header('Content-Type: application/json');
if (isset($_POST['function']) && $_POST['function'] == 'sendMail') {
    $PONo = $_POST['PONo'];
    $sql = "SELECT DISTINCT * FROM PO WHERE PONo = '$PONo'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    $email_1 = $result['Email_one'];
    $email_2 = $result['Email_two'];
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = "smtp.samt.co.th";
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "system@samt.co.th";
    $mail->Password = "Shippo@1234";
    $mail->setFrom('system@samt.co.th', 'system mail');
    $mail->addAddress($email_1);
    if ($email_2 != "") {
        $mail->addCC($email_2);
        $mail->addCC("system@samt.co.th");
    } else {
        $mail->addCC("system@samt.co.th");
    }

    $mail->addAttachment("C:/Users/samt/Downloads/PO$PONo.pdf");

    $mail->isHTML(true);

    $mail->Subject = "Test P.O.mail";
    $mail->msgHTML("Dear Horita san.<br> This is Test send P.O. file to maker with signature approve.<br><br><br> Best Regards,<br> Panrawee Seesang");
    if (!$mail->send()) {
        $data = array(
            'status' => 0,
            'message' => $mail->ErrorInfo,
        );
        echo json_encode($data);
    } else {
        $data = array(
            'status' => 1,
        );
        echo json_encode($data);
    }
}
