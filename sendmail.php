<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Wenn Composer verwendet wird, ist dies erforderlich
//require 'vendor/autoload.php';

require 'C:\xampp\htdocs\shortTermRental\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\shortTermRental\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\shortTermRental\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server-Einstellungen
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'k.arnold789@gmail.com';
    $mail->Password   = 'Arnold!1999';
    $mail->SMTPSecure = 'tls'; // Änderung von ssl zu tls
    $mail->Port       = 587;

    // Empfänger
    $mail->setFrom('k.arnold789@gmail.com', 'Arnold');
    $mail->addAddress('wi22b069@technikum-wien.at', 'Kovacs');

    // Inhalt
    $mail->isHTML(true);
    $mail->Subject = 'Betreff der E-Mail';
    $mail->Body    = 'Inhalt der E-Mail';

    $mail->send();
    echo 'E-Mail wurde erfolgreich versendet';
} catch (Exception $e) {
    echo "E-Mail konnte nicht gesendet werden. Fehler: {$mail->ErrorInfo}";
}
?>
