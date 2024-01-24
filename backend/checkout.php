<?php
include 'db/conn.php';
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);

$stripe_secret_key = "sk_test_51OAYItKu6zNIBVrcw0v4AQHEzyC9YnXmP924BS5bN0ghoLAeSn8o8MGcx64tslI975nWycYnBV6e4wYKbUtiPKtm00UDXB6ZVI";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$flat_id = $_GET['flat_id']; 
$start_date = new DateTime($_GET['start_date']); 
$end_date = new DateTime($_GET['end_date']);

$formattedStartDate = $start_date->format('Y-m-d'); // Formatieren des Startdatums
$formattedEndDate = $end_date->format('Y-m-d'); // Formatieren des Enddatums


// Calculate the difference in days
$interval = $start_date->diff($end_date);
$days = $interval->days;

try {
    $query = "SELECT * FROM flats WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$flat_id]);
    $flat = $stmt->fetch();

    // Throw an exception if the flat doesn't exist
    if (!$flat) {
        throw new Exception("Flat with ID $flat_id not found.");
    }

    $product_name = "Flat Rental: " . $flat['name'];
    $flatId = $flat['id'];
    //$flatId = $flat['id'];

    // Calculate the total amount
    $amount = $flat['price'] * $days * 100; // Stripe requires the amount in cents

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/shortTermRental/frontend/index.php",
        "cancel_url" => "http://localhost/shortTermRental/frontend/cancel.php",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "eur",
                    "unit_amount" => $amount,
                    "product_data" => [
                        "name" => $product_name . " for $days days"
                    ],
                ],
            ],
        ],
    ]);

    // Hier beginnt der E-Mail-Versand
    try {
        $mail = new PHPMailer(true); // Erstellen Sie eine Instanz von PHPMailer

        // Konfigurieren Sie PHPMailer (SMTP-Einstellungen)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ihr SMTP-Server
        $mail->SMTPAuth = true;
        $mail->Username = 'clemens10927@gmail.com'; // Ihr SMTP-Benutzername
        $mail->Password = 'ofkb ghit wzdw cqgu'; // Ihr SMTP-Passwort
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Empfänger und Absender
        $mail->setFrom('clemens10927@gmail.com', 'Shorttermrental');
        $mail->addAddress('wi22b069@technikum-wien.at', 'Admin'); // Empfänger der E-Mail

        // E-Mail-Inhalt
        $mail->isHTML(true);
        $mail->Subject = 'Buchungsbestaetigung';
        // E-Mail-Content
        $emailContent = '
        <html>
        <head>
          <style>
            .email-container {
              background-color: #f4f4f4;
              padding: 20px;
              font-family: Arial, sans-serif;
            }
            .email-header {
              background-color: #007bff;
              color: white;
              padding: 10px;
              text-align: center;
            }
            .email-content {
              background-color: white;
              padding: 20px;
              margin-top: 10px;
            }
          </style>
        </head>
        <body>
          <div class="email-container">
            <div class="email-header">
              <h1>Buchungsbestaetigung</h1>
            </div>
            <div class="email-content">
              <p>Sehr geehrte(r) Herr/Frau Admin</p>
              <p>Es ist eine Buchung eingegangen. Hier sind die Details der Buchung:</p>
              <ul>
                <li>' . $product_name . '</li>
                <li>Von: ' . $formattedStartDate . '</li>
                <li>Bis: ' . $formattedEndDate . '</li>
                <li>Flat (ID): ' . $flatId . '</li>
                <li>Betrag: ' . $amount/100 .  ' Euro </li>
              </ul>
              <p>Weiter so :)</p>
            </div>
          </div>
        </body>
        </html>
        ';

        $mail->Body = $emailContent;

        $mail->SMTPOptions = array(
          'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
          )
      );

        $mail->send();
    } catch (Exception $e) {
        // Fehler beim Senden der E-Mail
    }


    // Weiterleitung zur Stripe-Zahlungsseite
    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit;

    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit;
} catch (Exception $e) {
    // Handle error appropriately
    http_response_code(500);
    echo "Error: " . $e->getMessage();
    exit;
}
?>
