<?php
include_once 'credenciales.php';
include_once 'Mailer/src/PHPMailer.php';
include_once 'Mailer/src/SMTP.php';
include_once 'Mailer/src/Exception.php';

function sendMail($destinatario, $motivo, $contenido) {
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = HOST;
        $mail->Port = PORT;
        $mail->SMTPAuth = SMTP_AUTH;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Username = REMITENTE;
        $mail->Password = PASSWORD;

        $mail->setFrom(REMITENTE, NOMBRE);
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $motivo;
        $mail->Body = $contenido;

        if($mail->send()) {
            return array("errno" => 0, "error" => "Enviado con éxito.");
        } else {
            return array("errno" => 1, "error" => "No se pudo enviar.");
        }
    } catch (Exception $e) {
        return array("errno" => 1, "error" => "Error: " . $e->getMessage());
    }
}
?>